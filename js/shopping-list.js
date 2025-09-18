// JavaScript Document
var addBtn = document.getElementById('addButton');
var elList = document.getElementById('list'); //bind a variable to my shopping list
var elCounter = document.getElementById('counter'); //bind a variable to the counter
var count = 0; //used to count shopping items
var idCount = 0; //unique value used to keep track of list ids

//adds an item to the shopping list
function addItem(){
	var newEl, newElText;
	var itemName = document.getElementById('itemName');
	newEl = document.createElement('div'); //prepare the new element
	newElText = document.createTextNode(itemName.value); //prepare the text for the new element
	newEl.setAttribute('id', idCount); //prepare an id for the new element
	
	//check if user tries to add blank item
	if (itemName.value==''){
		window.alert('Item name cannot be blank!');
	}
	else{
		//success
		newEl.setAttribute('type', 'button'); //add type "button" to the new element
		newEl.classList.add('btn'); //add class to the new element
		newEl.classList.add('btn-info'); //add class to the new element
		newEl.classList.add('btn-lg'); //add class to the new element
		newEl.classList.add('btn-block'); //add class to the new element
		newEl.classList.add('active'); //add class to the new element
		newEl.appendChild(newElText); //add text to the new element
		elList.appendChild(newEl); //add new element to the text
		newEl.addEventListener('click', function(){removeItem(newEl.id)}, false); //add an event listener to each item that calls removeItem() on click
		updateCount(1); //incr the list amount
		idCount++; //incr to the next unique id
		itemName.value=''; //clear the previous entry
	}
}

//removes an item from the shopping list
function removeItem(id){
	var el = document.getElementById(id);
	el.parentNode.removeChild(el);
	updateCount(0);
}

//updates the item count
function updateCount(num){
	//if an item is added, a '1' will be sent as the param and the counter will increment
	if(num == 1){
		count++;
		elCounter.innerHTML = count;
	}
	//if an item is removed, a '0' will be sent as the param and the counter will decrement
	else{
		count--;
		elCounter.innerHTML = count;
	}
}

addBtn.addEventListener('click', addItem, false);

