page = document.getElementById("page");


function ToBlocks()
{
    htmlblocks = page.children;
    blocks = [];
    i = 0;
    //console.log(htmlblocks);
    Array.from(htmlblocks).forEach(function (element) {
        //console.log(element);
        blocks[i] = [element.id, element.innerText];
        i ++;
      });
      //console.log(blocks);
    return JSON.stringify(blocks);
}



function Save()
{
    fetch("/write-rest.php?page=/hii",
    {
        method: "POST",

        body: "newblocks="+ToBlocks(),
        headers: 
        {
            "Content-Type": "application/x-www-form-urlencoded"
        }

    });
}