import requests
from bs4 import BeautifulSoup # Found on google (library for web scraping "extract image URLs from <img>")
import os

# Function to download images
def download_image(url, directory):
    response = requests.get(url)
    if response.status_code == 200:
        # Extract the filename from the URL
        filename = os.path.join(directory, os.path.basename(url))
        
        # Save the image to a file as binary
        with open(filename, 'wb') as img_file:
            img_file.write(response.content)
        print(f"Succesfully downloaded: {filename}")
    else:
        print(f"Error downloading image: {url}")

# Function to parse and download images from HTML content
def downloadImages(html_content, base_url, output_directory):
    soup = BeautifulSoup(html_content, 'html.parser')
    
    # Find all image tags (<img>)
    img_tags = soup.find_all('img')
    
    for img in img_tags:
        src = img.get('src') # Contains the image URL
        if src:
            # Construct the absolute URL for the image
            img_url = src if src.startswith('http') else base_url + src
            
            # Download and save the image
            download_image(img_url, output_directory)

if __name__ == "__main__":
    url = "http://www.google.com/"
    
    # Fetch the HTML content
    response = requests.get(url)
    
    if response.status_code == 200:
        html_content = response.content
        output_directory = "downloaded_images"
        
        # Create the output directory if it doesn't exist
        if not os.path.exists(output_directory):
            os.makedirs(output_directory)
        
        downloadImages(html_content, url, output_directory)
    else:
        print(f"Error fetching HTML content from {url}")
