//17.12.2019
$(document).ready(function()
	{
		document.getElementById("sel_some").value = '';
		
		document.getElementById("userFIO").value = '';
		
			$("#sel_some").on("input",function(data){
				//обсчет всех элементов в выбранном
				var curStr = $('#sel_some').val();
				var sys = checkRadioBtn();
				if(curStr.length >= 3)
				{
					$.ajax({
					type: 'POST',
					url: 'engine.php',
					dataType: 'json',
					data: {
							action: "getPrivs",
							txt_priv: curStr,
							without: callChildtoStr('grants'),
							sheme: sys
						  }, 
					success: function(data) 
						{
							$("#main").html('');
							for (var i = 0; i < data.length; i++)
							{
								var txt = data[i]['TXT'];
								var divID = data[i]['ID_PRIV'];
								createDIV(txt, 'main', divID, 'do', 'ID_PRIV_'+divID);
							}
						}
						});
				}
				else
				{
					$("#main").html('');
				}
				});

				$(document).on('click','div[name^="ID_PRIV_"]', function(data)
				{
					let newNode = '';
					this.parentNode.id == 'grants' ? newNode = 'main' : newNode = 'grants';
					console.log(this.id+' '+this.parentNode.id);
					if(this.id != 'undefined')
					{
						moveDIV(this.id, newNode, 'done');
						console.log(qntChild('grants'));
					}
					qntChild('grants') > 0 ? $('#refresh').show() : $('#refresh').hide();
					qntChild('grants') > 0 ? $('#userFIO').show() : $('#userFIO').hide();
					console.log(checkRadioBtn());
				});
				
		//поиск Юзера		
		$("#userFIO").on("input",function(data){
		
		let curUser = $('#userFIO').val();
		if(curUser.length >= 3)
				{
					$.ajax({
						type: 'POST',
						url: 'engine.php',
						dataType: 'json',
						data: {
								action: "getUser",
								user: curUser
							  }, 
						success: function(data) 
							{
							$("#block").html('');	
							$('#block').css('display', 'block');
							createSelDIV(data, 'block'); //вывод возвращанных пользователей
							}
					}); 
				$(document).on('click','div[name^="GOOD_"]', function(data)
				{
					document.getElementById("userFIO").value = this.id;
					$('#block').css('display', 'none');
				});
				}
		else if (curUser.length < 3)
		{
		$("#block").html('');	
		$('#block').css('display', 'none');
		}
		
		$(document).keydown(function(eventObject){
			if( eventObject.which == 27 ){
				document.getElementById("userFIO").value = '';
				$("#block").html('');	
				$('#block').css('display', 'none');
			};
		});
		
		});			
	});

function createSelDIV(divDATA, idPar)
{
let _par = document.getElementById(idPar);
for (let i = 0; i < divDATA.length; i++)
	{
		let _div = document.createElement('DIV');
		_div.innerHTML = divDATA[i]['USR'];
		_div.id = divDATA[i]['LOGIN'];
		if(divDATA[i]['STATE'] == 'BLOCKED') //добавим нейм для простоты при выборе "GOOD"
		{
			_div.classList.add('listOfUsers_Bad');
			_div.setAttribute('name', 'BAD_'+divDATA[i]['LOGIN']);
		}
		else 
		{
		_div.classList.add('listOfUsers');
		_div.setAttribute('name', 'GOOD_'+divDATA[i]['LOGIN']);			
		}
		_par.appendChild(_div);
	}
}



function createOption(idPar, optArr)
{
var _par = document.getElementById(idPar);
for(let i=0; i<optArr.length; i++)
{
var option = document.createElement("option");
option.innerHTML = optArr[i]['USR'];
option.id = optArr[i]['LOGIN'];
		if(optArr[i]['STATE'] == 'BLOCKED')
		{
			option.style="background-color: #ff033e;";
		}
option.classList.add('selected');	
_par.appendChild(option);
}
}


function checkRadioBtn()
{
	var scheme = document.getElementsByName("rdbtn");
	//console.log(scheme);
	
	for(var i = 0; i < scheme.length; i++)
	{
		if (scheme[i].type == "radio" && scheme[i].checked)
		{
			var choise = scheme[i].id;
		}
	}
	
	return choise;
}


function qntChild(idParDiv)
{
	return document.getElementById(idParDiv).childNodes.length;
}

function callChildtoStr(idParDiv)
{
let oldDiv = document.getElementById(idParDiv).childNodes;
let Arr = [];
let str = '';
if(oldDiv.length != 0)
{
	for(let i = 0; i < oldDiv.length; i++)
		{
			Arr[i] = oldDiv[i].id;
		}
	str = Arr.join(',');
}
return str;
}

function createDIV(txtDiv, idEl, idDiv, divClass, divName)
{
var _div = document.createElement('DIV');
_div.innerHTML = txtDiv;
_div.id = idDiv;
_div.classList.add(divClass);
_div.setAttribute('name', divName);
document.getElementById(idEl).appendChild(_div);
}

function moveDIV(idDiv, secondPar, newClass)
{
let _secPar = document.getElementById(secondPar);
let _div = document.getElementById(idDiv);
	if(newClass)
	{
	_div.classList.add(newClass);
	}
_secPar.appendChild(_div);
}


function createBttn(nameBtn, idEl, idBtn)
{
var _butt = document.createElement("BUTTON");
_butt.innerHTML = nameBtn;
_butt.id = idBtn;
document.getElementById(idEl).appendChild(_butt);
}

