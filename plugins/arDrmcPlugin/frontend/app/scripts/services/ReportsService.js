'use strict';

module.exports = function ($http, SETTINGS) {

  this.getBrowse = function () {
    return $http({
      method: 'GET',
      url: SETTINGS.frontendPath + 'api/reports/browse'
    });
  };

  this.generateReport = function (data) {
    var configuration = {
      method: 'POST',
      url: SETTINGS.frontendPath + 'api/report'
    };

    if (angular.isDefined(data)) {
      // configuration.data = data;
    }

    // Only required if using GET!
    // Convert range object into a flat pair of params: from and to
    // if (angular.isDefined(params.range)) {
    //  params.from = params.range.from;
    //  params.to = params.range.to;
    //  delete params.range;
    // }

    return $http(configuration);
  };

  this.deleteReport = function (id) {
    return $http({
      method: 'DELETE',
      url: SETTINGS.frontendPath + 'api/reports/' + id
    });
  };

};
