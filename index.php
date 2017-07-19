<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css"> 
    <script src= "http://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular.min.js"></script> 
	<style>
	span{color:red}
	h3{background:green;color:white;height:50px}
	</style>
</head>
<body ng-app="postApp" ng-controller="postController">
<div class="container">
<h3>{{message}}</h3>
<div class="col-sm-8 col-sm-offset-2">
    <div class="page-header"><h1>Insert data into mysql table using angularJS</h1></div>
    <!-- FORM -->
    <form name="studentForm" ng-submit="submitForm()" >
    <div class="form-group">
        <label>Student Name</label>
        <input type="text" class="form-control" ng-model="student.sname">
        <span ng-show="errorName">{{errorName}}</span>
    </div>
    <div class="form-group">
        <label>Department</label>
        <input type="text"class="form-control" ng-model="student.sdpt">
        <span ng-show="errorUserName">{{errorUserName}}</span>
    </div>
    <div class="form-group">
        <label>Student ID</label>
        <input type="text"  class="form-control" ng-model="student.sid">
        <span ng-show="errorEmail">{{errorEmail}}</span>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>
</div>
</body>
<script>
    // Defining angularjs application.
    var postApp = angular.module('postApp', []);
    // Controller function and passing $http service and $scope var.
    postApp.controller('postController', function($scope, $http) {
      // create a blank object to handle form data.
        $scope.student = {};
      // calling our submit function.
        $scope.submitForm = function() {
        // Posting data to php file
        $http({
          method  : 'POST',
          url     : 'insert.php',
          data    : $scope.student, //forms student object
          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
         })
          .success(function(data) {
            if (data.errors) {
              // Showing errors.
              $scope.errorName = data.errors.name;
              $scope.errorUserName = data.errors.username;
              $scope.errorEmail = data.errors.email;
            } else {
              $scope.message = data.message;
			$scope.studentForm.$setPristine(); 
            }
          });
        };
    });
</script>
<a style="text-align:center;margin-top:80px;float:left" href="http://ogroosoft.com" >By AL EMRAN ,Founder & CEO of OgrooSoft</a>
</html>