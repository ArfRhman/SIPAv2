(function (Handsontable) {
  "use strict";
  /**
   * Handsontable confirmUsulan plugin. See `demo/buttons.html` for example usage
   * This plugin is not a part of the Handsontable build (to use it, you must load it after loading Handsontable)
   * See `test/confirmUsulanSpec.js` for tests
   */
  function confirmUsulan() {

    var eventManager = Handsontable.eventManager(this);

    function bindMouseEvents() {
      var instance = this;

      /*
      eventManager.addEventListener(instance.rootElement, 'mouseover', function (e) {
        if(checkRowHeader(e.target)) {
          var element = getElementFromTargetElement(e.target);
          if (element) {
            var btn = getButton(element);
            if (btn) {
              btn.style.display = 'block';
            }
          }
        }
      });

      eventManager.addEventListener(instance.rootElement, 'mouseout', function (e) {
        if(checkRowHeader(e.target)) {
          var element = getElementFromTargetElement(e.target);
          if (element) {
            var btn = getButton(element);
            if (btn) {
              btn.style.display = 'none';
            }
          }
        }
      });
      
      */

//      instance.rootElement.on('mouseover.confirmUsulan', 'tbody th, tbody td', function () {
//        getButton(this).show();
//      });
//
//      instance.rootElement.on('mouseout.confirmUsulan', 'tbody th, tbody td', function () {
//        getButton(this).hide();
//      });
    }

    var getElementFromTargetElement = function (element) {
      if (element.tagName != 'TABLE') {
        if (element.tagName == 'TH' || element.tagName == 'TD') {
          return element;
        } else {
          return getElementFromTargetElement(element.parentNode);
        }
      }
      return null;
    };

    var checkRowHeader = function (element) {
      if (element.tagName != 'BODY') {
        if (element.parentNode.tagName == 'TBODY') {
          return true;
        } else {
          element = element.parentNode;
          return checkRowHeader(element);
        }
      }
      return false;
    };

    function unbindMouseEvents() {
      eventManager.clear();
    }

    function getButton(td) {
      var btn = td.querySelector('.btn');

      if (!btn) {
        var parent = td.parentNode.querySelector('th.htconfirmUsulan');

        if (parent) {
          btn = parent.querySelector('.btn');
        }
      }

      return btn;
    }

    this.init = function () {
      var instance = this;
      var pluginEnabled = !!(instance.getSettings().confirmUsulanPlugin);

      if (pluginEnabled) {
        bindMouseEvents.call(this);
        Handsontable.Dom.addClass(instance.rootElement, 'htconfirmUsulan');
      } else {
        unbindMouseEvents.call(this);
        Handsontable.Dom.removeClass(instance.rootElement, 'htconfirmUsulan');
      }
    };

    this.beforeInitWalkontable = function (walkontableConfig) {
      var instance = this;
          
      /**
       * rowHeaders is a function, so to alter the actual value we need to alter the result returned by this function
       */
      var baseRowHeaders = walkontableConfig.rowHeaders;
      walkontableConfig.rowHeaders = function () {

        var pluginEnabled = !!(instance.getSettings().confirmUsulanPlugin);

        var newRowHeader = function (row, elem) {
          var child
            , div;
          var kd_item = instance.getData()[row][10];
            
          while (child = elem.lastChild) {
            elem.removeChild(child);
          }
          elem.className = 'htNoFrame htconfirmUsulan';
          if (row > 1) {
            if(kd_item != '' && kd_item != null){  
                div = document.createElement('div');
                div.className = 'btn btn-small btn-warning btn-icon icon-pencil';
                div.appendChild(document.createTextNode(' '));
                elem.appendChild(div);
                
                
                eventManager.addEventListener(div, 'mouseup', function () {
                    //alert("cek masuk : "+ instance.getData()[row][10]);    
                    
                    $.ajax({
                        url: 'http://localhost/SPPB/c_usulan/getRincianUsulanByKd',
                        type: "POST",
                        data: { "kd_item" : kd_item},
                        success:function(res){
                            //alert(res);
                            var data = JSON.parse(res);
                            //alert(data + " tes : " + data['NM_ITEM']);
                            //instance.alter('remove_row', row);
                            
                            var user_group = $("#user_group").val();
                            
                            //alert("group id : " + user_group);
                            if(user_group == 2){
                                alert("masuk");
                                $("#form-comment").html($("#form_add_comment_unit").html());
                            
                            }
                            else
                                $("#form-comment").html($("#form_add_comment").html()); 

                            
                            $("#KD_PAKET").val(data["KD_PAKET"]);
                            $("#KD_ITEM").val(data["KD_ITEM"]);
                            $("#NM_ITEM").val(data["NM_ITEM"]);
                            $("#SPESIFIKASI").val(data["SPESIFIKASI"]);
                            $("#SETARA").val(data["SETARA"]);
                            $("#SATUAN").val(data["SATUAN"]);
                            $("#QTY").val(data["QTY"]);
                            $("#TOTAL").val(data["TOTAL"]);
                            $("#HARGA_SATUAN").val(data["HARGA_SATUAN"]);
                            $("#HARGA_HPS").val(data["HARGA_HPS"]);
                            $("#PERTANYAAN").val(data["PERTANYAAN"]);
                            $("#KONFIRMASI").val(data["KONFIRMASI"]);
                            $("#text-pertanyaan").html(data["PERTANYAAN"]);
                            $("#text-konfirmasi").html(data["KONFIRMASI"]);
                            //$("#change_status").attr("href", this.id);
                            $(".modal").attr("style","width:950px; left:35%;z-index:1050");
                            jQuery("#add_comment").modal('show', { backdrop: 'static' });
                            //e.preventDefault();   
                            
                        },
                        error:function(res){
                            alert(res);
                            //e.preventDefault();
                        }
                    })
                    
                    

                    
                    
                    
                });
            }
              
          }
        };

        return pluginEnabled ? Array.prototype.concat.call([], newRowHeader, baseRowHeaders()) : baseRowHeaders();
      };
    }
  }

  var htconfirmUsulan = new confirmUsulan();

  Handsontable.hooks.add('beforeInitWalkontable', function (walkontableConfig) {
    htconfirmUsulan.beforeInitWalkontable.call(this, walkontableConfig);
  });

  Handsontable.hooks.add('beforeInit', function () {
    htconfirmUsulan.init.call(this)
  });

  Handsontable.hooks.add('afterUpdateSettings', function () {
    htconfirmUsulan.init.call(this)
  });

})(Handsontable);
