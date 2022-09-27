var btn_prev, btn_next, inp_page, total_page, range_zoom;
var canvas;
var statusPDF = {}
var url = '../documents/1_CURSO_ISO_9001_2015_V3.pdf';

setTimeout(() => {
    init();
    initEvents();
    loading();
}, 100);

function init() {
    btn_prev =document.getElementById('btn_prev');
    btn_next =document.getElementById('btn_next');
    inp_page =document.getElementById('page');
    total_page =document.getElementById('total_page');
    range_zoom =document.getElementById('range_zoom'); 
    canvas =document.getElementById('pdf_canvas');
}
function initEvents() {
    btn_prev.addEventListener('click',previous_page);
    btn_next.addEventListener('click',next_page);
    inp_page.addEventListener('change',change_page);
    range_zoom.addEventListener('input',zoom);
    document.body.addEventListener('contextmenu', e => {e.preventDefault();});
    resetStatusPDF();
}
function resetStatusPDF() {
	statusPDF = {
		file: null,
		countOfPages: 0,
		currentPage: 1,
		zoom: 1
	}
}
function loading() {
    pdfjsLib.getDocument(url).promise.then(pdf=>{
        statusPDF.file=pdf;
        statusPDF.countOfPages=pdf.numPages;
        total_page.textContent=pdf.numPages;
        inp_page.max=pdf.numPages;
        render();
    });
}


function render() {
    statusPDF.file.getPage(statusPDF.currentPage).then(page =>{
        var context=canvas.getContext('2d');
        var viewport= page.getViewport({scale:statusPDF.zoom});
        canvas.width=viewport.width;
        canvas.height=viewport.height;
        var renderContext = {
			canvasContext: context,
			viewport: viewport
		};
		page.render(renderContext);        
    });
    inp_page.value=statusPDF.currentPage;
}
function previous_page() {
    var isValidPage = statusPDF.currentPage - 1 > 0;
	if (isValidPage) {
		statusPDF.currentPage -= 1;
		render();
	}
}
function next_page() {
    var isValidPage = statusPDF.currentPage < statusPDF.countOfPages;
	if (isValidPage) {
		statusPDF.currentPage += 1;
		render();
	}
}
function change_page() {
    var valor=parseInt(inp_page.value);
    if (valor > 0 && valor <= statusPDF.countOfPages) {
		statusPDF.currentPage = valor;
		render();
	}
}
function zoom() {
    var escala=1;
    switch (range_zoom.value) {
        case '0':escala=0.25
            break;
        case '10':escala=0.4
            break;
        case '20':escala=0.55
            break;
        case '30':escala=0.7
            break;
        case '40':escala=0.85
            break;
        case '50':escala=1
            break;
        case '60':escala=1.15 
            break;
        case '70':escala=1.30
            break;
        case '80':escala=1.45
            break;
        case '90':escala=1.60
            break;
        case '100':escala=1.75
            break;
    }
    statusPDF.zoom = escala;
    render();
}
