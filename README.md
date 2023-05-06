# Photo Gallery Plugin

This is a custom photo gallery plugin for WordPress that allows users to upload and categorize photos, and filter them by category using an AJAX request.

## Features
- Upload photos with descriptions and assign them to categories
- Create custom taxonomy for photos called ```category```
- Filter photos on the page by category using ```AJAX``` requests
- Display photo descriptions on hover

## Installation

To install this plugin, follow these steps:

1. Download the plugin files and place them in the ```/wp-content/plugins/photo-gallery``` directory.
2. Activate the plugin through the ```Plugins``` screen in WordPress.

## Usage
To use this plugin, follow next steps:

1. Navigate to the ```Gallery Photos``` menu item in the WordPress admin dashboard.
2. Click the ```Add Gallery Photo``` button and upload a new photo.
3. Enter a title and select a category for the photo.
4. Click the ```Publish``` button to save the photo.
5. View the photo gallery on the frontend of the website.
6. Use the category filters to filter the gallery by category.

<div align="center">
  <img
       src="https://user-images.githubusercontent.com/50755505/236622674-520f1136-2328-4ec8-904e-b206650c29d9.jpg"
       width="80%"
       height="80%"
       alt="Server-side architecture">
</div>

$$\textcolor{#454545}{Plugin's \ capabilities}$$

## Implementation details
### Custom taxonomy for photos called "category"
A custom taxonomy called ```category``` has been created for the ```gallery_photo``` post type, which allows users to categorize their photos.

### Upload photos with descriptions and assign them to categories
Users can upload photos with descriptions and assign them to categories using the custom taxonomy mentioned above.

### Photo descriptions on hover
When a user hovers over a photo in the gallery, the photo's description will be displayed.

### Filter photos on the page by category using AJAX requests
An ```AJAX``` request has been created to filter photos by category. The ```AJAX``` request is triggered when the user clicks on a category filter button. The request is only processed for authenticated users. The ```AJAX``` request works by sending the selected category as data to the server, which returns the necessary HTML code for the filtered gallery. If the request is successful, all photos on the current page are removed and only the filtered photos are displayed.

<div align="center">
  <img
       src="https://user-images.githubusercontent.com/50755505/236622745-9fcb535e-048c-4b67-9220-e0fa8667f6a9.png"
       width="70%"
       height="80%"
       alt="Server-side architecture">
</div>

$$\textcolor{#454545}{Final \ look}$$
