let data = [];
let page_count = 1;
let paginationPages = 1;
const entriesPerPage = 5;
const maxNumOfPaginationLinks = 5;

async function widget()
{
    //init();
    let ibp_opportunities = await fetch_IBP_Opportunities();
    let ecrinp_opportunities = await fetch_ECRINP_Opportunities();
    data = data.concat(ibp_opportunities);
    data = data.concat(ecrinp_opportunities);
    
    data = data.filter(function( element ) {
        return element !== undefined;
     });

    data.sort(function(a, b){
        return -1*(new Date(b.closing_date) - new Date(a.closing_date));
    });
    
    page_count = Math.ceil(data.length/entriesPerPage);
    paginationPages = Math.ceil(page_count/maxNumOfPaginationLinks);

    if(data.length > 0)
    getPage(1);
}

function init()
{
    let htmlcontent = `<div class="row"> <div class="col-4"> <nav aria-label="view_page"><ul class="pagination pagination-sm justify-content-center"><li class="page-item active" aria-current="page"><a class="page-link">1</a></li></ul></nav></div>`;
    htmlContent = htmlcontent + ` <div class="row"><div class="col-4"> <div class="list-group" id="list-tab" role="tablist">
        <a data-bs-toggle="list" href="#list-none" role="tab" aria-controls="list-none" id="list-none-list" class="list-group-item list-group-item-action" aria-current="true">
            <h5 class="mb-1">Waiting for data...</h5> 
        </a> 
         </div>
        </div>
        <div class="col-8">
          <div class="tab-content" id="nav-tabContent">
          </div>
        </div>
        </div>`;
    
    let container = document.getElementById("opportunities_table");
    container.innerHTML = htmlContent;
}

async function fetch_IBP_Opportunities()
{
    let url = 'https://www.innovationbridge.info/ibportal/feeds/rinp/opportunities';
    try {
        let res = await fetch(url);
        res_json = await res.json();

        return await res_json.map(elem => {
            return {
                title: elem.title,
                description: elem.field_description,
                closing_date: elem.field_closing_date,
                website: elem.field_website,
                source: 'Innovation Bridge'
            }
        });
    } catch (error) {
        console.log(error);
    }

}

async function fetch_ECRINP_Opportunities()
{
    let url = 'https://innovateec.co.za/portal/api/calls';
    try {
        let res = await fetch(url);
        res_json = await res.json();

        return await res_json.map(elem => {
            return {
                title: elem.title,
                description: elem.description,
                closing_date: elem.closing_date,
                website:'',
                source: 'EC-RINP'
            }
        });
    } catch (error) {
        console.log(error);
    }
}

function getPage(page)
{
   let htmlContent = '';
   htmlContent = htmlContent + generatePaginator(page);
   htmlContent = htmlContent + generateList(((page-1)*entriesPerPage), (page*entriesPerPage)-1 < data.length-1 ?  (page*entriesPerPage)-1 : data.length-1);

   let container = document.getElementById("opportunities_table");
   container.innerHTML = htmlContent;
}

function generatePaginator(active)
{
    let paginator =  `<div class="row">
    <div class="col-4">
    <nav aria-label="view_page">
    <ul class="pagination pagination-sm justify-content-center">`;
   
    paginator = paginator + `<li class="page-item  ` + ((active-1 > 0) ? `` : `disabled`) + `"><a class="page-link" href="#" onclick="getPage(` + ((active-1 > 0) ? active-1 : 1) + `)">Previous</a></li>`;
    currPaginatorEnd = Math.min(Math.ceil(active/maxNumOfPaginationLinks)*maxNumOfPaginationLinks, page_count);
    currPaginatorStart = Math.max(currPaginatorEnd-maxNumOfPaginationLinks+1, 1);

    for(i = currPaginatorStart; i <= currPaginatorEnd; i++)
    {
      if(i == active)
      paginator = paginator + ` <li class="page-item active"><a class="page-link" href="#" onclick="getPage(` + i + `)">` + i + `</a></li>`;
      else
      paginator = paginator + ` <li class="page-item"><a class="page-link" href="#" onclick="getPage(` + i + `)">` + i + `</a></li>`;

    }
          
    paginator = paginator + ` <li class="page-item ` + ((active+1) > page_count ? `disabled` : ``) +`"><a class="page-link" href="#" onclick="getPage(` + ((active+1) > page_count ? page_count : (active+1)) + `)">Next</a></li>`

    paginator = paginator + `</ul></nav></div></div>`;
    return paginator;
}

function generateList(start, stop)
{
    let htmlContent = `<div class="row">`;
    let listContent = `<div class="col-4"> <div class="list-group" id="list-tab" role="tablist">`;
    let descriptionContent = `<div class="col-8"> <div class="tab-content" id="nav-tabContent">`;

    for(i = start; i <= stop; i++)
    {
        listContent = listContent + generateItem(data[i], i);
        descriptionContent = descriptionContent  + generateDescription(data[i], i);

    }

    listContent = listContent + ` </div> </div>`;
    descriptionContent = descriptionContent + `</div> </div>`
    return htmlContent = htmlContent + listContent + descriptionContent + `</div>`;
}

function generateItem(call, id)
{
    let item =  `<a  data-bs-toggle="list" href="#item-`+ id +`" role="tab" aria-controls="list-profile" id="list-profile-list" class="list-group-item list-group-item-action" aria-current="true">`;
    item = item + `<h5 class="mb-1">` + (call.title.length > 110 ? call.title.substring(0, 110) + `...` : call.title) + `</h5>`;
    item = item + `<div class="d-flex w-100 justify-content-between">`;
    item = item + `<small>Closing Date: ` + call.closing_date + `</small>`;
    item = item + `<small>Source: ` + call.source + `</small></div></a>`;
    return item;
}

function generateDescription(call, id)
{
    let description =  `<div class="tab-pane fade" id="item-` + id + `" role="tabpanel" style="overflow: auto; height:400px;">`;
    description = description + `<h1>` + call.title + `</h1></br>`;
    description = description + ` <p>` + call.description + `</p></br></br>`;
    description = description  + `<h5>Closing date: </h5>` + call.closing_date + `</br>`;
    description = description + `<h5>Website: </h5><a href="`+ call.website +`">` + call.website + `</a></br>`;
    description = description + `</div>`;
    return description;
}