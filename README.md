# EPC and GHL API Integration to Postcode Gravity Form 

### API Key for Go High Level
For sending contacts to a sub-account of GHL, a sub-account API key must be used. The current sub-account in use in the [private-api script](https://github.com/ljsherlock/epc-api-gravity-form/private-api.php) is **Greenhouse Energy**, so this will need to be changed to whichever sub-account is to hold new contacts.

1. Get API key for sub-account in GHL (Settings --> Business Profile --> API Key)
2. Duplicate and rename the [private-api script](https://github.com/ljsherlock/epc-api-gravity-form/private-api.php)  to suit your needs (e.g. private-api-[SUB-ACCOUNT NAME].php)
3. Change the API key on your copy on line 98 e.g. `Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9... etc` 

## WordPress Site
1. Export both forms (https://redr40.sg-host.com/wp-admin/admin.php?page=gf_export&subview=export_form) (API Lookup Form & Follow On Form)
2. Import into your desired WP install
3.  In both forms (IDs 3 and 5), change the `API_URL` variable to the custom api for this sub-account. 
	-  In each form, there is a **JS Block**, where you will find a `API_URL` variable at the top, update this with your new [private-api script](). 
	- e.g. `const API_URL = 'https://dbr.fts.mybluehost.me/private-api-greenhouse-energy.php';`

### Capture Gravity Forms WP action
1. Grab a copy of the [Capture Gravity Forms snippet](https://redr40.sg-host.com/wp-admin/admin.php?page=wpcode-snippet-manager&snippet_id=117).
	- We are using the WP Plugin **WPCode Lite** (install this first, or add to functions.php)
2. Change the `CURLOPT_URL` value to your custom [private-api script](https://github.com/ljsherlock/epc-api-gravity-form/private-api.php) e.g. `CURLOPT_URL => 'https://dbr.fts.mybluehost.me/private-api-greenhouse-energy.php?create-contact',`
3. Add the snippet to the aforementioned location.