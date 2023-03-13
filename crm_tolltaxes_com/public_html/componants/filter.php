<button onclick="filterFormTglBtn()">Try it</button>
<div id="filterFormTglModel">
This is a DIV element.
</div>
<script>
function filterFormTglBtn() {
   var element = document.getElementById("filterFormTglModel");
   element.classList.toggle("mystyle");
}
</script>
