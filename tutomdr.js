(function() {
   // Main
   
   var callback = function(res) {
      console.log(res);
      // location.teub
   };
   
   function requestTaMere(data, callback) {
      data += ' hello';
      setTimeout(function() {
         console.log('in timeout');
         callback(data);
      }, 2000);
   }
   
   requestTaMere('coucou', callback);
   
})()