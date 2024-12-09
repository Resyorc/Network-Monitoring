
import numpy as np
import json
import requests
from sklearn.ensemble import IsolationForest
from sklearn.impute import SimpleImputer
from sklearn.preprocessing import LabelEncoder

# Dummy training data (for testing purposes)
data = [
    [1, -50, 6],  # [PacketType (encoded), RSSI, Channel]
    [2, -40, 11],
    [1, -60, 1],
]
model = IsolationForest().fit(data)

# Function to encode categorical data (like 'type' field)


def encode_categorical_data(packets):
    label_encoder = LabelEncoder()
    encoded_packets = []

    for packet in packets:
        # Assuming packet[0] is 'type', which is categorical (e.g., 'Control')
        encoded_type = label_encoder.fit_transform([packet[0]])[
            0]  # Encode 'type'
        # [encoded_type, rssi, channel]
        encoded_packets.append([encoded_type, packet[1], packet[2]])

    return encoded_packets

# Function to process input data and make predictions


def predict(input_data):
    input_data = np.array(input_data)

    # Impute missing values (NaN) using SimpleImputer
    imputer = SimpleImputer(strategy='mean')
    input_data = imputer.fit_transform(input_data)

    # Make predictions using the Isolation Forest model
    predictions = model.predict(input_data)
    return predictions

# Function to fetch data from the API


def get_data_from_api():
    # Replace with the correct endpoint URL
    url = 'http://127.0.0.1:8000/api/packets'
    try:
        response = requests.get(url)
        if response.status_code == 200:
            data = response.json()

            # Extract only the fields required for the model: 'type', 'rssi', 'channel'
            packets = [
                # Extract the relevant fields
                [packet['type'], packet['rssi'], packet['channel']]
                for packet in data
                if 'type' in packet and 'rssi' in packet and 'channel' in packet
            ]
            return packets
        else:
            print(f"Error: Unable to fetch data from {
                  url} (status code: {response.status_code})")
            return []
    except requests.exceptions.RequestException as e:
        print(f"Error: Request failed - {e}")
        return []


# Main function
if __name__ == "__main__":
    input_data = get_data_from_api()

    if input_data:
        # Encode categorical data (like 'type')
        encoded_data = encode_categorical_data(input_data)

        # Reshape the input data as required by the model (ensure it's a 2D array)
        input_data = np.array(encoded_data).reshape(-1, 3)

        # Predict using the model
        results = predict(input_data)
        # Output predictions as a JSON list
        print(json.dumps(results.tolist()))
    else:
        print("No data available to process.")
