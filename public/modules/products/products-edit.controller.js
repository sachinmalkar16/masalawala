(function () {
    'use strict';

    angular.module('MyApp')
        .controller('ProductsEditController', ProductsEditController);

    // '$modal' ProductsSpecSvc
    ProductsEditController.$inject = ['$scope','Utils', '$http', 'SettingSvc', '$state', 'ProductsSvc', 'CategoriesSvc', '$stateParams','Upload','$timeout','toastr'];

    function ProductsEditController($scope,Utils, $http, SettingSvc, $state, ProductsSvc, CategoriesSvc, $stateParams,Upload, $timeout,toastr) {
        var vm = this;
        vm.categories = [];
        vm.activeTab = 0;
        vm.editMode = false;
        vm.url = SettingSvc.getPhotoUrl();
        vm.currency = 'Rs'; //Utils.getCookie('setting').currency;
        vm.product = {};
        // vm.image = [];


        var init = function () {
            //retrieve the product
            if ($stateParams.pId != undefined) {
                ProductsSvc.findById($stateParams.pId).then(function (result) {
                    vm.product = result.data.product;
                    vm.product_photos = result.data.photos;
                    vm.reviews = result.data.reviews;
                    delete vm.product.id;
                    //prepare data formats
                    vm.editMode = true;
                });
            }
            //retrieve spec & categories
            CategoriesSvc.list().then(function (result) {
                vm.categories = result.data;
            });
        }
        init();

        vm.save = function () {
            if (vm.editMode == true) {
                update();
            }
            else {
                create();
            }
        }

        var create = function () {
            ProductsSvc.create(vm.product).then(function (result) {
                if (result.data > 0) {
                    $state.go("products-edit", {pId: result.data});
                }
                else
                    var myModal = $modal({title: 'Error', content: 'Something is Wrong!', show: true});
            });
        }
        var update = function () {
            ProductsSvc.update(vm.product, $stateParams.pId).then(function (result) {
                if (result.data != false) {
                    //$state.go($state.current, {}, {reload: true});
                }
                else
                    var myModal = $modal({title: 'Error', content: 'Something is Wrong!', show: true});
            });
        }

        vm.remove = function () {
            ProductsSvc.remove($stateParams.pId).then(function (result) {
                if (result.data == false)
                    var myModal = $modal({title: 'Error', content: 'Something is Wrong!', show: true});
                else
                    $state.go("products-list");
            });
        }


        vm.uploadImage = function () {
            var file = vm.product_image;
            var fd = new FormData();
            fd.append("product_image", file);
           // fd.append("data", JSON.stringify(data));
            ProductsSvc.uploadImage(fd, $stateParams.pId).then(function (result) {
                vm.product.images.push(result.data);
                vm.save();
            });
        }

        vm.uploadFiles = function(files, errFiles) {
            vm.fileuploading=true;
            vm.files = files;
            vm.errFiles = errFiles;
            angular.forEach(files, function(file) {
                file.upload = Upload.upload({
                    url: SettingSvc.getRootUrl() + "/product/upload_image/" + $stateParams.pId,
                    data: {product_image: file}
                });

                file.upload.then(function (response) {
                    $timeout(function () {
                        file.result = response.data.success;
                        file.message  = response.data.message;
                        vm.fileuploading=false;

                        var photo= response.data.photo;
                        vm.product_photos.push(photo);
                    });
                }, function (response) {
                    if (response.status > 0)
                        vm.errorMsg = response.status + ': ' + response.data;
                }, function (evt) {
                    file.progress = Math.min(100, parseInt(100.0 *
                        evt.loaded / evt.total));
                });
            });
        }


        vm.removeImage = function (imageId) {
            ProductsSvc.removeImage($stateParams.pId, imageId).then(function (result) {
                console.log(result.data);
                var index = vm.product.images.indexOf(src);
                vm.product.images.splice(index, 1);
                vm.save();
            });
        }

        vm.showReply = function(review) {
            review.showReply = true;
        };

        vm.reply = function(review) {
            var reply ={
                'comment': angular.copy(review.newComment.description),
                'parent_id': review.id,
                'product_id': review.product_id,
                'user': $scope.user,
                'user_id': $scope.user.id,
                'replies': [],
                'showReply':false
            };

            ProductsSvc.saveReply(reply, $stateParams.pId).then(function (result) {
                if (result.data != false) {
                    //$state.go($state.current, {}, {reload: true});
                    toastr.info('Reply save');
                    review.replies.push(reply);
                }
                else
                    //var myModal = $modal({title: 'Error', content: 'Something is Wrong!', show: true});
                    $scope.serverErrors = response.data.errors;
            });
            review.newComment.description = '';
            review.showReply = false;
        };


        vm.goTo = function (url) {
            $state.go(url);
        }

    }
})();