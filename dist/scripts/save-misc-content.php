<!--
@license
Copyright (c) 2015 The Polymer Project Authors. All rights reserved.
This code may only be used under the BSD style license found at http://polymer.github.io/LICENSE.txt
The complete set of authors may be found at http://polymer.github.io/AUTHORS.txt
The complete set of contributors may be found at http://polymer.github.io/CONTRIBUTORS.txt
Code distributed by Google as part of the polymer project is also
subject to an additional IP rights grant found at http://polymer.github.io/PATENTS.txt
-->

<link rel="import" href="../../bower_components/polymer/polymer.html">
<link rel="import" href="../../bower_components/paper-styles/typography.html">
<link rel="import" href="../../bower_components/paper-input/paper-input.html">
<link rel="import" href="../../bower_components/paper-input/paper-textarea.html">
<link rel="import" href="../../bower_components/file-upload/file-upload.html">
<link rel="import" href="../../bower_components/iron-ajax/iron-ajax.html">
<link rel="import" href="../../bower_components/paper-fab/paper-fab.html">
<link rel="import" href="../../bower_components/paper-dialog/paper-dialog.html">
<link rel="import" href="../../bower_components/paper-dialog-scrollable/paper-dialog-scrollable.html">
<link rel="import" href="../../bower_components/neon-animation/animations/scale-up-animation.html">
<link rel="import" href="../../bower_components/neon-animation/animations/fade-out-animation.html">
<link rel="import" href="../../bower_components/iron-pages/iron-pages.html">
<link rel="import" href="../../bower_components/paper-button/paper-button.html">
<link rel="import" href="../../bower_components/iron-icon/iron-icon.html">


<dom-module id="admin-misc">
  <template>
    <style>
      :host {
        display: block;
      }
      
    .container-desktop {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }
    
    h4 {
      margin-bottom: 0;
      margin-top: 20px;
    }
    
    .card {
      box-shadow: 1px 1px 5px #ccc;
      margin: 20px;
      padding: 20px;
    }
    
    .instructions {
      background: rgba(250, 150, 150, 0.3);
      border-radius: 5;
      padding: 15px;
    }
    
    paper-toast {
      --paper-toast-background-color: green;
      --paper-toast-color: white
    }
    
    </style>
    
    <iron-ajax id="getMiscContent" url="https://lasallepub.com/scripts/get-misc-content.php" last-response="{{miscData}}" auto></iron-ajax>
    
    <iron-ajax id="saveMiscContent" url="https://lasallepub.com/scripts/save-misc-content.php?subtitle={{miscData.subtitle}}&
    slidetitle1={{miscData.slidetitle1}}&slidetitle2={{miscData.slidetitle2}}&slidetitle3={{miscData.slidetitle3}}&
    instragram={{miscData.instragram}}&twitter={{miscData.twitter}}&facebook={{miscData.facebook}}&
    supportContent={{miscData.supportContent}}&aboutContent={{miscData.aboutContent}}" last-response="{{miscDataSavedResponse}}"></iron-ajax>

    
    <div class="container-desktop">
      {{miscDataSavedResponse}}
      <div class="card">
        <h4>Subtitle</h4>
      
        <paper-input char-counter type="text" label="Subtitle" value="{{miscData.subtitle}}"></paper-input>
        
       
      </div>
      
      <div class="card">
        <h4>Slide Titles</h4>
        
        <paper-input char-counter type="text" label="Slide Title 1" value="{{miscData.slidetitle1}}"></paper-input>
        <paper-input char-counter type="text" label="Slide Title 2" value="{{miscData.slidetitle2}}"></paper-input>
        <paper-input char-counter type="text" label="Slide Title 3" value="{{miscData.slidetitle3}}"></paper-input>        
      </div>



      <div class="card">
        <h4>Social Media Links</h4>
        <p class="instructions">Enter the complete url (including http://)<br>ex: http://www.google.com</p>
        
        <paper-input type="text" label="Instagram URL" value="{{miscData.instragram}}"></paper-input>
        <paper-input type="text" label="Twitter URL" value="{{miscData.twitter}}"></paper-input>
        <paper-input type="text" label="Facebook URL" value="{{miscData.facebook}}"></paper-input>
        
                
      </div>

      
      <div class="card">
        <h4>Page Content</h4>
        <p class="instructions">To add a new paragraph, simply wrap the text inside a &lt;p&gt;&lt;/p&gt; tag. <br>
        ex: <code>&lt;p&gt;Paragrap 1&lt;/p&gt;&lt;p&gt;Paragrap 2&lt;/p&gt;</code></p>
        
        <paper-textarea rows=5 label="Support Page" value="{{miscData.supportContent}}"></paper-textarea>
        
        <br>
        
        <paper-textarea rows=5 label="About Page" value="{{miscData.aboutContent}}"></paper-textarea>
                 
      </div>
      
       
      <div class="layout horizontal end-justified">
        <paper-button on-click="updateContent">
         <iron-icon style="padding-right: 10px; padding-bottom: 3px;" icon="icons:save"></iron-icon>Save</paper-button>
         
      </div>
    </div>
    
    <paper-toast id="updateNotification" text="Changes have been saved successfully!"></paper-toast>

   
  </template>

  <script>
    (function() {
      'use strict';

      Polymer({
        is: 'admin-misc',

        properties: {
          items: {
            type: Array,
            notify: true,
          },
          miscDataSavedResponse: {
            observer: '_miscDataSavedResponseChanged'
          }
        },
        updateContent: function () {
          this.$.saveMiscContent.generateRequest();
        },
        
        _miscDataSavedResponseChanged: function () {
          this.$.updateNotification.open();
        }
        
      });
    })();
  </script>
</dom-module>
