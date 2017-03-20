/**
* JavaScript routines for Krumo
*
* @version $Id: krumo.js 2 2007-04-17 04:43:21Z mrasnika $
* @link http://sourceforge.net/projects/krumo
*/

/////////////////////////////////////////////////////////////////////////////

/**
* Krumo JS Class
*/
function krumo() {
	}

// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 

/**
* Add a CSS class to an HTML element
*
* @param HtmlElement el 
* @param string className 
* @return void
*/
krumo.reclass = function(el, className) {
	if (el.className.indexOf(className) < 0) {
		el.className += (' ' + className);
		}
	}

// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 

/**
* Remove a CSS class to an HTML element
*
* @param HtmlElement el 
* @param string className 
* @return void
*/
krumo.unclass = function(el, className) {
	if (el.className.indexOf(className) > -1) {
		el.className = el.className.replace(className, '');
		}
	}

// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 

/**
* Toggle the nodes connected to an HTML element
*
* @param HtmlElement el 
* @return void
*/
krumo.toggle = function(el) {
	var ul = el.parentNode.getElementsByTagName('ul');
	for (var i=0; i<ul.length; i++) {
		if (ul[i].parentNode.parentNode == el.parentNode) {
			ul[i].parentNode.style.display = (ul[i].parentNode.style.display == 'none')
				? 'block'
				: 'none';
			}
		}

	// toggle class
	//
	if (ul[0].parentNode.style.display == 'block') {
		krumo.reclass(el, 'krumo-opened');
		} else {
		krumo.unclass(el, 'krumo-opened');
		}
	}

// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 

/**
* Hover over an HTML element
*
* @param HtmlElement el 
* @return void
*/
krumo.over = function(el) {
	krumo.reclass(el, 'krumo-hover');
	}

// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 

/**
* Hover out an HTML element
*
* @param HtmlElement el 
* @return void
*/

krumo.out = function(el) {
	krumo.unclass(el, 'krumo-hover');
	}
	
/////////////////////////////////////////////////////////////////////////////


function showHide(element_id) {
//���� ������� � id-������ element_id ����������
if (document.getElementById(element_id)) {
	//���������� ������ �� ������� � ���������� obj
	var obj = document.getElementById(element_id);
	//���� css-�������� display �� block, ��:
	if (obj.style.display != "block") {
		obj.style.display = "block"; //���������� �������
	}
	else obj.style.display = "none"; //�������� �������
}
//���� ������� � id-������ element_id �� ������, �� ������� ���������
else alert("������� � id: " + element_id + " �� ������!");
}

