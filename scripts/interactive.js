function openPost(postId) { // Runs from listado_posts.html
  const post = document.getElementById('post_' + postId); // Get post details
  const postTitle = post.getElementsByClassName('cell_title')[0].innerHTML;
  const postBody = post.getElementsByClassName('cell_body')[0].innerHTML;
  const frame = parent.document.getElementById("post_frame"); // Get frame and 
  frame.style.display = "block"; // Make frame visible

  const frameDoc = frame.contentDocument || frame.contentWindow.document; // Get iframe's document
  frameDoc.getElementById("h_title").innerHTML = postTitle;
  frameDoc.getElementById("m_body").innerHTML = postBody;
  // TODO: author and date
}

function closePost() { // Runs from post.html
  const frame = parent.parent.document.getElementById("post_frame");
  frame.style.display = "none"; // Hide post frame
}