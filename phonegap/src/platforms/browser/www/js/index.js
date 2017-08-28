/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */
var app = {
    // Application Constructor
    initialize: function() {
        this.bindEvents();
    },
    // Bind Event Listeners
    //
    // Bind any events that are required on startup. Common events are:
    // 'load', 'deviceready', 'offline', and 'online'.
    bindEvents: function() {
        document.addEventListener('deviceready', this.onDeviceReady, false);
        /*document.addEventListener('deviceready', function() {
        var promise = Kinvey.init({
                appKey    : 'af86c6c58e514a45acfa7b0a56ff642b',
                appSecret : '2786e39b23f444e6b42506925d78a098'
            });
            promise.then(function(activeUser) {
               alert('ok');
            }, function(error) {
                alert('error');
            });
        }, false);*/
    },
    // deviceready Event Handler
    //
    // The scope of 'this' is the event. In order to call the 'receivedEvent'
    // function, we must explicitly call 'app.receivedEvent(...);'
    onDeviceReady: function() {
        app.receivedEvent('deviceready');
        app.browser = cordova.InAppBrowser.open('http://192.168.100.5/QuranNote/public/dashboard', '_blank', 'location=no,zoom=no,hidden=yes');
        //app.browser = cordova.InAppBrowser.open('https://www.quranmemo.com/public/dashboard?starting=yes', '_blank', 'location=no,zoom=no,hidden=yes');
        // disable back
        document.addEventListener("backbutton", function (e) {
            e.preventDefault();
            if (confirm("Are you sure you want to exit app?")) {
                navigator.app.exitApp();
            }   
        }, false );

        
        app.browser.addEventListener('loadstop', function() {
            app.browser.show();
            /*var promise = Kinvey.ping();
            promise.then(function(response) {
                console.log('Kinvey Ping Success. Kinvey Service is alive, version: ' + response.version + ', response: ' + response.kinvey);
            }, function(error) {
                console.log('Kinvey Ping Failed. Response: ' + error.description);
            });
            console.log('here');*/
        });
    },
    onOffline: function(){
        alert('asd');
    },
    // Update DOM on a Received Event
    receivedEvent: function(id) {
        var parentElement = document.getElementById(id);
        var listeningElement = parentElement.querySelector('.listening');
        var receivedElement = parentElement.querySelector('.received');

        listeningElement.setAttribute('style', 'display:none;');
        receivedElement.setAttribute('style', 'display:block;');

        console.log('Received Event: ' + id);
    }
};
