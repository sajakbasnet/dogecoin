"use strict";

var DropzoneExample = function () {
  var DropzoneDemos = function DropzoneDemos() {
    Dropzone.options.singleFileUpload = {
      paramName: "file",
      maxFiles: 1,
      maxFilesize: 5,
      accept: function accept(file, done) {
        if (file.name == "justinbieber.jpg") {
          done("Naha, you don't.");
        } else {
          done();
        }
      }
    };
    Dropzone.options.multiFileUpload = {
      paramName: "file",
      maxFiles: 10,
      maxFilesize: 10,
      accept: function accept(file, done) {
        if (file.name == "justinbieber.jpg") {
          done("Naha, you don't.");
        } else {
          done();
        }
      }
    };
    Dropzone.options.fileTypeValidation = {
      paramName: "file",
      maxFiles: 10,
      maxFilesize: 10,
      acceptedFiles: "image/*,application/pdf,.psd",
      accept: function accept(file, done) {
        if (file.name == "justinbieber.jpg") {
          done("Naha, you don't.");
        } else {
          done();
        }
      }
    };
  };

  return {
    init: function init() {
      DropzoneDemos();
    }
  };
}();

DropzoneExample.init();