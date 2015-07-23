app.factory('TaskModel', function($http) {

    //Create model class
    var TaskModel = function(taskData){
        if (taskData) {
            this.setData(taskData);
        }
    };

    //Add methods to this model
    TaskModel.prototype = {
        setData: function (taskData) {
            angular.extend(this, taskData);
        }
    };

    return TaskModel;
});