# BE WPForms Secret Key

This plugin lets you validate form submissions using a secret key you provide. Bots with JavaScript disabled won't validate.

## Setup
1. Install the plugin
2. Go to WPForms and edit your form
3. Go to Settings > Secret Key and specify something. It can be anything.
4. Go to Fields and add a "Hidden Field". Under CSS Classes, add "secret-key".

When the page loads, this plugin will use JavaScript to update the value of the hidden field to use your secret key. When the form is submitted, if the secret key is different or blank (ie: spam bot without JS submitted it), it will be marked as spam.
