'use strict';
app.directive('loginDirective',function(){
	return{
		templateUrl:'partials/tpl/login.tpl.html'
	}

});


app.directive('tooltip', function(){
    return {
        restrict: 'A',
        link: function(scope, element, attrs){
            $(element).hover(function(){
                // on mouseenter
                $(element).tooltip('show');
            }, function(){
                // on mouseleave
                $(element).tooltip('hide');
            });
        }
    };
});