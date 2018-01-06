# Social Privacy Buttons for Joomla!
**Joomla! Module to display social sharing buttons for various networks without tracking scripts!**

**We are just preparing to provide the first release. Until then the module is WORK IN PROGRESS**

## About this Joomla! module
Yet another social sharing add-in for Joomla! ???
Social privacy buttons has been developed with one goal: Offer sharing buttons to Joomla! websites AND ensuring privacy for your users.

### What do we mean by privacy?
Integrating social sharing buttons is easy. Just search for something like "facebook share button" on the internet and you will get html + js snippets you can integrate into your website.
The drawback of this approach is that javascript is executed on the machine of the user of your website. By that social networks can easily collect user information all over the internet: Which IP-address visited which websites on which time of the day.
We want to protect the privacy of the people surfing the internet.

### How does "Social Privacy Buttons" protect the privacy of users?
Instead of sharing buttons that are loaded from a social network itself this Joomla! module uses simple hyperlinks to share the current URL on a social network. Therefore no connection to the social network is established, if the user does not explicitly want to by sharing something.

### How can we still see the number of shares / likes / pins?
This is achieved via your Joomla! installation. The server calls the APIs of the different social networks to retrieve details about the current URL. (e.g. 12 people pinned this URL)

### Will this module increase the loading time of my website?
Normally it can slow down a website to load data from different sources before delivering a website.
Social Privacy Buttons keeps your website speed by calling the social networks via an extra ajax request to your server. Therefore the site is already rendered while Joomla is retrieving the likes / shares and pins in the social networks. When the data is available the count fields will be updated automatically.

### Which social networks and channels are supported by "Social Privacy Buttons for Joomla?"
So far the following sharing methods are supported
* Facebook
* Twitter
* Google+
* LinkedIn
* Pinterest
* Whatsapp
* eMail

### Which languages are supported?
Right now the module supports the following languages
* English (en-GB)
* German (de-DE)
* Spanish (es-ES)

### Where can I see a demo of this Joomla! module?
We installed the module in two different places on this website: https://www.yoga-on-holiday.com/
Example: https://www.yoga-on-holiday.com/about-us/blog/1599-free-listing-of-your-yoga-retreats-in-3-languages

### Dependencies of this Joomla! module
* Seblod for Articles - will be removed
* FontAwesome - will be integrated and optional

### Next Steps for first release
* Add CSS for Bootstrap 4 Display utilities (until Joomla! 4 is available)
