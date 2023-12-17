url = window.location.href;
pagediv = document.getElementById("page");
extrasDiv = document.getElementById("writeExtras");
pagename = url.split("/")[4];

availableBlocks = [];

var selectedNode;

function simplifyHTML(html)
{
    console.log(html);
    html = html.replace(/\<span class="\s*(.*?) textstyle">(.*?)<\/span>/g, "^$1* $2 *$1*");
    
    html = html.replace(/\*([^\*\^]*)\*(\s*)\^([^\*\^]*)\*/g,
    function(match, tag1, contents, tag2)
    {
        if(tag1 == tag2)
        {
            return contents;
        }
        else
        {
            return match;
        }
    });
    return html
}

function ToBlocks()
{
    htmlblocks = pagediv.getElementsByClassName("block");
    blocks = [];
    i = 0;
    Array.from(htmlblocks).forEach(function (element) {
        j = 0;
        variables = [];
        Array.from(element.querySelectorAll(".variable")).forEach(variable => {
            variables[j] = simplifyHTML(variable.innerHTML);
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
    const responce = await fetch("/write-rest.php?page=/"+pagename+"&getblocks=true");
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
    selectedNode.after(block);
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

function deleteSelected()
{
    if(selectedNode.className == "block")
    {
        selectedNode.remove();
    }
}

function addLink()
{
    if (window.getSelection().toString())
    {
        var a = document.createElement('a');
        a.href = prompt("enter a url: ");
        window.getSelection().getRangeAt(0).surroundContents(a);
    }
}

function addWrappingNode(tag)
{
    newnode = document.createElement('span');
    newnode.classList = tag + " textstyle";
    window.getSelection().getRangeAt(0).surroundContents(newnode);
    
}

LoadAvailableBlocks().then(function()
{
    i = 0;
    availableBlocks.forEach(block => {
        addingButton = document.createElement('input');
        addingButton.setAttribute("type", "button");
        addingButton.value = "add "+block[0];
        addingButton.addEventListener("click", AddBlock.bind(this, i));
        extrasDiv.appendChild(addingButton);
        i++;
    });
});

document.addEventListener("click", (e) => {
    if(e.target.className == 'variable' || e.target.className == 'writeheader' )
    {
        block = e.target.closest(".block, .headerblock");
        extrasDiv.style.top = (block.offsetTop + block.offsetHeight + 10) + "px";
        extrasDiv.classList.remove("hidden")
        selectedNode = block;
    }
    else
    {
        extrasDiv.style.top = null;
        extrasDiv.classList.add("hidden")
    }
})