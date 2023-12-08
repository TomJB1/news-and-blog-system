url = window.location.href;
pagediv = document.getElementById("page");
pagename = url.split("/")[4];

function ToBlocks()
{
    htmlblocks = pagediv.children;
    blocks = [];
    i = 0;
    Array.from(htmlblocks).forEach(function (element) {
        blocks[i] = [element.id, element.innerText];
        i ++;
      });
    return JSON.stringify(blocks);
}

function Save()
{
    fetch("/write-rest.php?page=/"+pagename,
    {
        method: "POST",

        body: "newblocks="+ToBlocks(),
        headers: 
        {
            "Content-Type": "application/x-www-form-urlencoded"
        }

    });
}