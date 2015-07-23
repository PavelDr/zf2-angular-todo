app.factory('TasksService', ['$http', '$q', 'TaskModel', function ($http, $q, TaskModel) {

    var tasksService = {
        _pool: {},
        _retrieveInstance: function (taskId, taskData) {
            var instance = this._pool[taskId];

            if (instance) {
                instance.setData(taskData);
            } else {
                instance = new TaskModel(taskData);
                this._pool[taskId] = instance;
            }

            return instance;
        },
        getTasks: function () {
            var deferred = $q.defer();
            var scope = this;
            $http.get('getTasks')
                .success(function (tasksArray) {
                    var tasks = [];
                    tasksArray.forEach(function (taskData) {
                        var task = scope._retrieveInstance(taskData.id, taskData);
                        tasks.push(task);
                    });

                    deferred.resolve(tasks);
                })
                .error(function () {
                    deferred.reject();
                });
            return deferred.promise;
        },
        add: function (text) {
            var deferred = $q.defer();
            var scope = this;
            $http.post('add', {text: text})
                .success(function (data) {

                    var task = null;
                    if (!data.success) {
                        alert(data.message);
                    } else {
                        var task = scope._retrieveInstance(data.result.id, data.result);
                    }
                    deferred.resolve(task);

                })
                .error(function () {
                    deferred.reject();
                });
            return deferred.promise;
        },
        edit: function (id, text, done) {
            var deferred = $q.defer();
            var scope = this;
            $http.post('edit', {
                id: id,
                text: text,
                done: +done
            })
                .success(function (data) {

                    var task = null;
                    if (!data.success) {
                        alert(data.message);
                    } else {
                        var task = scope._retrieveInstance(data.result.id, data.result);
                    }
                    deferred.resolve(task);

                })
                .error(function () {
                    deferred.reject();
                });
            return deferred.promise;
        },
        delete: function () {
            var deferred = $q.defer();
            var scope = this;
            $http.get('delete')
                .success(function (tasksArray) {
                    var tasks = [];
                    tasksArray.forEach(function (taskData) {
                        var task = scope._retrieveInstance(taskData.id, taskData);
                        tasks.push(task);
                    });

                    deferred.resolve(tasks);
                })
                .error(function () {
                    deferred.reject();
                });
            return deferred.promise;
        }
    };
    return tasksService;
}]);