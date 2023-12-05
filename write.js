page = document.getElementById("page");

function Ajax(method, path, callback)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        if(callback)
        {
            callback(this.responseText);
        }
    }
  };
  xhttp.open(method, path, true);
  xhttp.send();
}

function ToBlocks()
{
    htmlblocks = page.children;
    blocks = [];
    i = 0;
    Array.from(htmlblocks).forEach(function (element) {
        blocks[i] = [element.id, element.innerText];
        i ++;
      });
    return blocks;
}

function Loaded(html)
{
    page.innerHTML = html;
}

function Load()
{
    Ajax("GET", "/write-rest.php?page=/hii", Loaded)
}

function Save()
{
    Ajax("POST", "/write-rest.php?page=/hii", null)
}

Load();
Save();