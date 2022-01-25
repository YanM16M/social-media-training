
function like(id) {
      jQuery.ajax({
      type: "GET",
      url: '../controllers/likeOrUnlike.php',
      dataType: 'json',
      data: {idPost: id},
      success: function (obj) {
              if(!('error' in obj) ) {
                  var res = obj.result;
                  console.log(res);
                  if (res == 'like') {
                      document.getElementById('lblLike'+id).textContent = parseInt(document.getElementById('lblLike'+id).textContent) + 1;
                      console.log("ok");
                  }
                  else {
                      document.getElementById('lblLike'+id).textContent = parseInt(document.getElementById('lblLike'+id).textContent) - 1;
                  }
              }
              else {
                  console.log(obj.error);
              }
        }
    });
}

function supprimerPost(id) {
    jQuery.ajax({
    type: "GET",
    url: '../controllers/deletePost.php',
    dataType: 'json',
    data: {idPost: id},
    success: function (obj) {
          document.getElementById("post"+id).innerHTML = "";
          document.getElementById("post"+id).outerHTML = "";
    }
    });
}

function search() {
    var login = document.getElementById('intLogin').value;
    jQuery.ajax({
    type: "GET",
    url: '../controllers/search.php',
    dataType: 'json',
    data: {login: login},
    success: function (obj) {
            if(!('error' in obj) ) {
                var res = obj.result;
                if (res == "Profil introuvable !") {
                    document.getElementById('searchResult').textContent = res;
                }
                else {
                    window.location = "./myPage.php?idPostFrom=" + res;
                }
            }
            else {
                console.log(obj.error);
            }
      }
    });
}

function AcceptRequest(id) {
    var login = document.getElementById('requestName'+id).textContent;
    jQuery.ajax({
    type: "GET",
    url: '../controllers/controlFriendRequest.php',
    dataType: 'json',
    data: {response: 'Oui', pseudoFriend:login},
    success: function (obj) {
            if(!('error' in obj) ) {
                var res = obj.result;
                if (res == "true") {
                    document.getElementById("requestList"+id).innerHTML = "";
                    document.getElementById("requestList"+id).outerHTML = "";
                }
            }
            else {
                console.log(obj.error);
            }
      }
    });
}

function DeclineRequest(id) {
    var login = document.getElementById('requestName'+id).textContent;
    jQuery.ajax({
    type: "GET",
    url: '../controllers/controlFriendRequest.php',
    dataType: 'json',
    data: {response: 'Non', friendPseudo:login},
    success: function (obj) {
            if(!('error' in obj) ) {
                var res = obj.result;
                if (res == "true") {
                    document.getElementById("requestList"+id).innerHTML = "";
                    document.getElementById("requestList"+id).outerHTML = "";
                }
            }
            else {
                console.log(obj.error);
            }
      }
    });
}

function newFriend() {
    login = $_GET('idPostFrom');
    jQuery.ajax({
    type: "GET",
    url: '../controllers/sendFriendRequest.php',
    dataType: 'json',
    data: {pseudo: login},
    success: function (obj) {
            if(!('error' in obj) ) {
                var res = obj.result;
                document.getElementById('btnNewFriend').textContent = res;
            }
            else {
                console.log(obj.error);
            }
      }
    });
}


function $_GET(param) {
	var vars = {};
	window.location.href.replace( location.hash, '' ).replace(
		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
		function( m, key, value ) { // callback
			vars[key] = value !== undefined ? value : '';
		}
	);

	if ( param ) {
		return vars[param] ? vars[param] : null;
	}
	return vars;
}
