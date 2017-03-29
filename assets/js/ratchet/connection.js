var Connection = (function(){

  function Connection(url) {

      this.open = false;

      this.socket = new WebSocket("ws://" + url);
      this.setupConnectionEvents();
    }

  Connection.prototype = {
    setupConnectionEvents : function () {
          var self = this;

          self.socket.onopen = function(evt) { self.connectionOpen(evt); };
          self.socket.onmessage = function(evt) { self.connectionMessage(evt); };
          self.socket.onclose = function(evt) { self.connectionClose(evt); };
      },

      connectionOpen : function(evt){
          this.open = true;
          this.addSystemMessage("Connected");
    },
      connectionMessage : function(evt){
          var data = JSON.parse(evt.data);
                
          this.addChatMessage(data.msg);
      },
      connectionClose : function(evt){
          this.open = false;
          this.addSystemMessage("Disconnected");
      },

      sendMsg : function(message){
          this.socket.send(JSON.stringify({
              msg : message
          }));

          console.log(message);
      },

      addChatMessage : function(data){
        
        switch(data.broadType){
          case Broadcast.POST : this.addNewPost(data); break;
          default : console.log("nothing to do");
        }
      },
    
      addNewPost : function(data){
      
        //var newPost = data.data;

        /*newHtml = "<div>"+
                "<span> "+ newPost + "</span>" +
                "</div>";

        $("#feedlist").prepend(newHtml);*/

          //newHtml = newPost;

          //console.log(data);
          if(data.data.status == 'diterima') {
              $('.'+data.data.idea_id).find('.statusdoang, .ttrim').hide();
              $('.'+data.data.idea_id).prepend('<span>Telah diterima</span>');
          } else if(data.data.status == 'ditolak') {
              $('.'+data.data.idea_id).find('.statusdoang, .ttrim').hide();
              $('.'+data.data.idea_id).prepend('<span>Telah ditolak</span>');
          } else if(data.data.status == 'batal') {
              $('.'+data.data.idea_id).find('.statusdoang, .ttrim').show();
              $('.'+data.data.idea_id).find('span').remove();
          } else {
              $('.'+data.data.idea_id).find('.statusdoang, .ttrim').hide();
              $('.'+data.data.idea_id).prepend('<span>Sedang dilihat</span>');
          }
      },
    
      addSystemMessage : function(msg){
          // this.chatwindow.innerHTML += "<p>" + msg + "</p>";
      }
    };

    return Connection;

})();
