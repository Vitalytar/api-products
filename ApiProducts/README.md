# API products parse
To parse products from the API, execute following command in CLI
- bin/magento apiproducts:import

Command accept 2 arguments:
- --page=number - is responsible for page, from which should be data parsed
- --size=number - is responsible for products count, which should be parsed

If arguments will not be specified, default values will be set:
- Page = 1
- Size = 30

This command will allow you to parse products from the API and data will be stored in 'api_products' DB table

# API Configuration on M2 side
To set API endpoint and key, do following steps:
- In Magento admin go to System -> Configuration
- Using 'Default Config' scope open General -> General
- Find and expand 'API Configuration' section
- Set correct API Endpoint and API Key values
- Click on the 'Save Config' button

As a result, configurations will be stored in DB and available within core_config_data DB table with path:
- general/api_configuration/api_endpoint
- general/api_configuration/api_key

These values are used to make a request to the API

# All data in admin
To see imported data via admin panel:
1. Open API CUSTOM PRODUCTS -> API Products List
2. Here you will see listing with all imported products from the API
