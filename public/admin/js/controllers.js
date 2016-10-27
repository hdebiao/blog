var adminControllers = angular.module('adminControllers',[]);
adminControllers.controller('home', ['$scope', '$http', function ($scope, $http) {
    "use strict";
    $scope.home = 'home controller';
}]);

adminControllers.controller('post', ['$scope', '$http', function ($scope, $http) {
    $scope.post_data = {};
    $scope.list = function () {
        $scope.post_data.page = $scope.paginationConf.currentPage;
        $scope.post_data.rpp = $scope.paginationConf.itemsPerPage;
        $http.post('/admin/post/list', $scope.post_data).success(function (data) {
            $scope.post = data.data;
            $scope.paginationConf.totalItems = data.total_num;
        });
    };

    // 配置分页基本参数
    $scope.paginationConf = {
        currentPage: 1,
        itemsPerPage: 10
    };
    // 通过$watch currentPage和itemperPage 当他们一变化的时候，重新获取数据条目
    $scope.$watch('paginationConf.currentPage + paginationConf.itemsPerPage', $scope.list);

    $scope.search = function (title) {
        $scope.post_data.title = title;
        $scope.paginationConf.currentPage = 1;
        $scope.list();
    }
}]);

adminControllers.controller('post-add', ['$scope', '$http', function ($scope, $http) {

}]);