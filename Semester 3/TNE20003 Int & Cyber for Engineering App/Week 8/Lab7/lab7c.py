import socket

target_host = "www.google.com"
target_port = 80

# Create a TCP socket and connect to the target host and port
client = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
client.connect((target_host, target_port))

# Construct the HTTP GET request
request = "GET / HTTP/1.0\r\nHost: {}\r\n\r\n".format(target_host)

# Send the request to the server
client.send(request.encode())

# Initialize variables to store response components
response = b""
header = b""
html_content = b""

# Receive and process the server's response
while True:
    data = client.recv(4096)
    if not data:
        break
    response += data

# Split the response into header and HTML content
header_end = response.find(b"\r\n\r\n")
if header_end != -1:
    header = response[:header_end]
    html_content = response[header_end + 4:]

# Decode the header and HTML content into strings
header_str = header.decode()
html_content_str = html_content.decode()

# Extract and display the HTTP response code and message
response_line = header_str.split('\r\n')[0]
response_parts = response_line.split(' ') # Splits individual words (HTTP/1.0, 200, OK) 
if len(response_parts) >= 2:
    response_code = response_parts[1]
    response_message = ' '.join(response_parts[2:])
    print(f"Response Code: {response_code}")
    print(f"Response Message: {response_message}")

# Extract and display the header content
header_lines = header_str.split('\r\n')[1:]
header_dict = {} # Initialize an empty dictionary
for line in header_lines:
    parts = line.split(': ') # Creates list called 'parts' e.g: ["Content-Type", "text/html"]
    if len(parts) == 2:
        header_dict[parts[0]] = parts[1]
print("\nHeader Content:")
for key, value in header_dict.items():
    print(f"{key}: {value}")

# Check the HTTP response code and display HTML content or an error message
if response_code == "200":
    print("\nHTML Content:")
    # print(html_content_str)
else:
    print(f"\nError: HTTP Response Code {response_code}")

# Close the socket connection
client.close()
