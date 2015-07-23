app.controller('IndexCtrl', ['$scope', 'TasksService', function($scope, tasksService) {

    $scope.tasks = [];

    tasksService.getTasks().then(function (tasks) {
       $scope.tasks = tasks;
    });

    $scope.add = function() {
        if(event.keyCode == 13 && $scope.taskText) {
            tasksService.add($scope.taskText).then(function(task) {
                if(task) {
                    $scope.tasks.push(task);
                }
                $scope.taskText = '';
            });
        }
    };

    $scope.toggleEditMode = function(){
        $(event.target).closest('li').toggleClass('editing');
    };

    $scope.editOnEnter = function(task){
        if(event.keyCode == 13 && task.text){
            tasksService.edit(task.id, task.text, task.done).then(function(task) {

            });
            $scope.toggleEditMode();
        }
    };

    $scope.remaining = function() {
        var count = 0;
        angular.forEach($scope.tasks, function(task) {
            count += task.done ? 0 : 1;
        });

        return count;
    };

    $scope.editDone = function (task) {
        done = !task.done;
        tasksService.edit(task.id, task.text, done).then(function(task) {
        });
    };

    $scope.hasDone = function() {
        return ($scope.tasks.length != $scope.remaining());
    };

    $scope.clear = function() {
        tasksService.delete().then(function (tasks) {
            $scope.tasks = tasks;
        });
    };
}]);
