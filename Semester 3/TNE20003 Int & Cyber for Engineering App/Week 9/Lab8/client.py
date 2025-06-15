import socket
import struct

# Function to send a message to the server
def send_message(client_socket, local_IP, port, header, message):
    # Pack the header and message into binary data
    data = struct.pack("10s 5s", header.encode("ASCII"), message.encode("ASCII"))
    
    # Send the binary data to the server at the specified address
    client_socket.sendto(data, (local_IP, port))

# Main function
def main():
    local_IP = "127.0.0.1"
    port = 9000

    # Define the header and message
    header, message, message2 = "TNE20004:", "HELLO", ""

    # Create a UDP socket for the client
    client_socket = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
    
    # Send a message to the server
    send_message(client_socket, local_IP, port, header, message)
    # send_message(client_socket, local_IP, port, header, message2) 

    # Receive a response from the server
    response = client_socket.recvfrom(1024)[0].decode("ASCII")
    # response2 = client_socket.recvfrom(1024)[0].decode("ASCII")

    # Print the server's reply and protocol parameters
    print("----- The server reply -----")
    print(response, end="\n\n----- The protocol parameters are -----\n")
    print(f"Header: {response[0:9]}\nMessage Type: {response[9:11]}\nMessage: {response[11:]}")

    # print("\n----- The server reply -----")
    # print(response2, end="\n\n----- The protocol parameters are -----\n")
    # print(f"Header: {response2[0:9]}\nMessage Type: {response2[9:11]}\nMessage: {response2[11:]}")

if __name__ == "__main__":
    main()
