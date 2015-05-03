
require.config({
  paths: {
    "jquery": "http://www.filelogix.com/buzz/js/jquery-1-10-2.min.js",
    "jquery-ui": "http://www.filelogix.com/buzz/js/jquery-ui-1.10.3.custom.min.js",
	"jquery-flex": "http://www.filelogix.com/buzz/js/jquery.flexslider.min.js"
  }
});

require(['jquery'], function() {
  //some code
});

require(['jquery-ui'], function() {
  //some code
});

require(['jquery-flex'], function() {
  //some code
});
