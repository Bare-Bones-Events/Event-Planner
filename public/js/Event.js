(function () {
    'use strict';

    var app = angular.module("Event", []);

    const TOKEN = $("meta[name=csrf-token]").attr("content");

    app.constant("CSRF_TOKEN", TOKEN);

    app.config(["$httpProvider", "CSRF_TOKEN", function($httpProvider, CSRF_TOKEN) {
        $httpProvider.defaults.headers.common["X-Csrf-Token"] = CSRF_TOKEN;
        $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
    }]);

    app.controller("ManageController", ["$http", "$log", "$scope", function($http, $log, $scope) {
        $scope.calendarevents = [];

        $http.get('/posts/list').then(function (response) {
            $log.info("Event list success response");

            $scope.posts = response.data;
        }, function (response) {
            $log.error("Event list error response");

            $log.debug(response);
        });

        $scope.parseDate = function (string) {
            var date = moment(string);
            return date.format();
        };

        $scope.deletePost = function (index) {
            var id = $scope.calendarevents[index].id;

            $http.delete('/events/' + id).then(function (response) {
                $log.info("Event successfully deleted");

                $scope.calendarevents.splice(index, 1);
            }, function (response) {
                $log.error("Event failed to delete");

                $log.debug(response);
            });
        }

        $scope.showModal = function (index) {
            $scope.currentEvent = $scope.calendarevents[index];

            $('#modal').modal();
        };

        $scope.editPost = function (editForm) {
            var id = $scope.currentEvent.id;

            $http.put('/events/' + id, {
                "event_name": $scope.currentEvent.event_name,
                "event_location" : $scope.currentEvent.event_location,
                "cost" : $scope.currentEvent.cost,
                "start_time" : $scope.currentEvent.start_time,
                "end_time" : $scope.currentEvent.end_time,
                "description" : $scope.currentEvent.description,
            }).then(function (response) {
                $log.info("Attempt to edit sent");

                $('#modal').modal('hide');
            }, function (response) {
                $log.error("Attempt to edit failed");

                $log.debug(response);
            });
        };
    }]);
})();
