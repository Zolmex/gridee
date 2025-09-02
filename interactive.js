function openPost(postId) { // Runs from listado_posts.html
  const post = document.getElementById('post_' + postId); // Get post details
  const postTitle = post.getElementsByClassName('cell_title')[0].innerHTML;
  const postBody = post.getElementsByClassName('cell_body')[0].innerHTML;
  const frame = parent.document.getElementById("post_frame"); // Get frame and 
  frame.style.display = "block"; // Make frame visible

  const frameDoc = frame.contentDocument || frame.contentWindow.document; // Get iframe's document
  // TODO: Update frame's info with the post's title and body
}

function closePost() { // Runs from post.html
  const frame = parent.parent.document.getElementById("post_frame");
  frame.style.display = "none"; // Hide post frame
}