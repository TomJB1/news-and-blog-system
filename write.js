url = window.location.href;
pagediv = document.getElementById("page");
extrasDiv = document.getElementById("writeExtras");
pagename = url.split("/")[4];

availableBlocks = [];

var nodeBefore;

function ToBlocks()
{
    htmlblocks = pagediv.children;
    blocks = [];
    i = 0;
    Array.from(htmlblocks).forEach(function (element) {
        j = 0;
        variables = [];
        Array.from(element.querySelectorAll(".variable")).forEach(variable => {
            variables[j] = variable.innerText;
            j++;
        });
        block = [element.id, ...variables];
        blocks[i] = block;
        i ++;
      });
    return JSON.stringify(blocks);
}

async function LoadAvailableBlocks()
{
    const responce = await fetch("/write-rest.php?page=/"+pagename+"&getblocks=true"); //[["title", '<h1>$var</h1>']];
    availableBlocks = await responce.json();
}


function AddBlock(blockid)
{
    blockArray = availableBlocks[blockid];
    blockHtml = (blockArray[1]).replaceAll("|var", "<div class='variable' contenteditable>write here</div>");
    block = document.createElement('div');
    block.className = 'block';
    block.id = blockArray[0];
    block.innerHTML = blockHtml;
    pagediv.insertBefore(block, nodeBefore);
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

LoadAvailableBlocks().then(function()
{
    console.log(availableBlocks);
    i = 0;
    availableBlocks.forEach(block => {
        console.log(block[0]);
        addingButton = document.createElement('input');
        addingButton.setAttribute("type", "button");
        addingButton.value = "add "+block[0];
        addingButton.addEventListener("click", AddBlock.bind(this, i));
        extrasDiv.appendChild(addingButton);
        i++;
    });
});

document.addEventListener("click", (e) => {
    if(e.target.className == 'variable')
    {
        console.log(e);
        extrasDiv.style.top = (e.target.offsetTop -30) + "px";
        nodeBefore = e.target.closest(".block");
    }
})