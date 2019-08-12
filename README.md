# buff_techs_inventory_web
Involved: Aurangzeb Malik and Dylan Golletib.
This is a web I am making for use as an inventory tool for Buff Techs. The basic idea here is to that we create a website were we can create QR labels that, we could then print out and put on hardware/tools, specifically hardware that may need to exit the main office for use on a dispatch case. This project was done using PHP and HTML/CSS/JavaScript.

## Procedure
Pick up a piece of hardware/tool with our label. Open your camera app, point at the label and you should be redirected to our webpage.(most smartphones camera app now days do this by default). Redirect will have two key things in the url that will be used for a get request later: a access token to prevent others whom don't work with buff techs from accessing and a deviceID. From there the user can input their unique username (ones we already use for work) to then checkout the item.

## App:
I also looked into the possibility of making a Mobile app version. To do this I looked into using a cross platform (Android and IOS) framework, after some review I ended up choosing Google's Flutter framework. I then designed a proof of concept app in flutter.
- [App Repo](https://github.com/auma91/Buff_Techs_Inventory)
