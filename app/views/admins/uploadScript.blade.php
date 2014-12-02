<script>
    (function(){
        var app = angular.module('uploadApp', [], function($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        });

        app.controller('UploadController', function(){
            
            this.form = {};
            this.form.partNumber = 1;

            this.form.links = [];

            this.form.parts = [];
            this.form.parts[0] = "put your link here 1";

            this.hidePHP = function(){
            	this.filter = true;
            }

            this.addPart = function(){
                var length = this.form.parts.length;
                
                // var lastIndex = length - 1;
                // $lastElem = $("input#part"+lastIndex);

                this.form.parts[length] = "add more " + length;
            }

            this.removePart = function(){
                if (this.form.parts.length > 1)
                    this.form.parts.pop();
                else
                    alert("You need at least 1 part!!!");
            }

            // $(document).on("click", "input", function(){
            //     alert($(this).attr("name"));
            // });
        });

        
    })();
</script>
