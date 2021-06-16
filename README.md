# Basic shopping cart in PHP

## Setup

This project requires:
- Windows (10+)
- [PHP (7.0+)](https://www.php.net/) 

This project uses the built in server already included in versions of PHP 5.0 and up. However the server is meant to be used for local development purposes and is not meant as a replacement for a full-featured web server. You can read more about it [here](https://www.php.net/manual/en/features.commandline.webserver.php).

## Run

To run the code in your local browser, run the following in your command prompt.

``` 
cd <your project directory>
php -S localhost:3000
```
## Functionality
- Add a product to the cart
- View current products in the cart
- Remove a product from the cart
- Product totals are tallied to give an overall total
- Adding an existing product will only update existing cart product quantity (e.g. adding the same product twice will NOT create two cart items)
- The cart keeps its “state” during page loads/refreshes


## Possible future improvements/features
- Ability to add/subtract item quantity from cart.
- Implement actual database to store products.
- Full code documentation
- Use an actual web server such as Apache
- Make it pretty