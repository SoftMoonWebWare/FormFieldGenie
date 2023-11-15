<?php  //character-encoding= UTF-8  tab spacing=2  editor width=120  auto-word-wrap=no

	/*/ test_FormFieldGenie.js   written by and Copyright © 2010, 2012, 2015, 2023 Joe Golembieski, SoftMoon WebWare

		See   http://softmoon-webware.com/FormFieldGenie-js_instructions.html
		See   http://softmoon-webware.com/code/


		This program is free software: you can redistribute it and/or modify
		it under the terms of the GNU General Public License as published by
		the Free Software Foundation, either version 3 of the License, or
		(at your option) any later version.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.

		You should have received a copy of the GNU General Public License
		along with this program.  If not, see <http://www.gnu.org/licenses/>    /*/

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title>Test FormFieldGenie.js</title>
<link rel="icon" type="image/x-icon" href="images/SoftMoonWebWare.gif">
<script type='text/javascript'>
// this is the namespace that the FormFieldGenie resides in:
const SoftMoon=Object.defineProperties({}, {WebWare: {value:{}, enumerable:true}});
</script>
<script type='text/javascript' src='JS_toolbucket/SoftMoon-WebWare/FormFieldGenie.js'></script>
<script type='text/javascript'>
// With this demo, we create one instance and pass options to match the application.
// You can also create individual instances each with their own options by passing in the options to the constructor
//  like this:  Genie1=new FormFieldGenie({ ...options...});  Genie2=new FormFieldGenie({ ...other options... });
// You can also pass in options to the constructor AND the method, with the method options taking precedence.
// By creating individual instances with different options, you clean up your HTML by simplifying the event handler
//  code; however, it may be easier to see and comprehend what is going on by including the options object in the
//  event handler code that calls the FormFieldGenie methods, as I did with this demo.
// This demo does not show off the Genie's ability to insert or delete.  HTML forms that need that ability must use
//  onclick event handlers that have the same options object as the onblur handler attached to the form element itself,
//  the difference being that the options object for the insert/delete must have one additional property, "doso" that
//  flags to do the inserting or deleting.  In this situation, it makes sense to create an individual instance, passing
//  the main body of the options object to the constructor, then simply pass an additional option to the method
//  like this:
//    Genie=new FormFieldGenie({ ...options... });
//  and:
//    <div><input type='text' onblur='Genie.popNewGroup(this.parentNode)'><span onclick='Genie.popNewGroup(this.parentNode, {doso:"insert"})'>insert above</span></div>
const Genie=new SoftMoon.WebWare.FormFieldGenie;
Genie.name='myGenie';  //this is used by the “update-value-genie” attribute in the “favorite pets” section.
</script>
<style>
body { color: lime;  background-color: black; }
fieldset { border: 1px solid white;  display: inline-block;  margin: .618em 2em .382em 0; }
div { background-color: #000020;  border: 1px solid red; }
table { border: 1px solid white;  margin-bottom: 1.618em; }
caption { font-weight: bold; }
table fieldset { margin: 0; }
#family td { width: 50%;  border: 1px solid blue; }
#pets td { width: 25%; }
.list label, #family label { display: block; }
.books { position: relative; padding-bottom: 4em; }
.below { position: relative; display: inline-block; width: 13em; }
.below input, .below textarea { position: absolute; top: 1.618em; left: 0 }
</style>
</head>
<body>

<?php if (isset($_POST['submit']))  echo "<h1>Var Dump</h1>\n<pre>",var_dump($_POST),"</pre>\n";  ?>

<h1>Additional fields appear automatically.&nbsp;
Previously filled fields disappear when cleared.&nbsp; Try using the TAB key to navigate.</h1>

<p>This demo does not record your answers or “do” anything.&nbsp;
When submitted, this form simply spits back your answers formatted as the server receives them.&nbsp;
Feel free to make up anything you like, or use the personal info of the guy in the cubicle next to you
to try out the features of this JavaScript Class:&nbsp; FormFieldGenie.js</p>

<form action="test_FormFieldGenie-js.php" method='post'
  onkeydown='if (event.key==="Enter"  &&  event.target.tagName!=="TEXTAREA"  &&  event.target.type!=="submit")  event.preventDefault();'>

<fieldset>
<legend>Enter all the names you use</legend>
<p>You may enter up to 10 names, one per box:</p>
<ol>
<li>
<select name='yourName[title][]'>
<option>Mr.</option>
<option>Ms.</option>
<option>Mrs.</option>
<option>Miss</option>
<option selected='selected'>The Honorable</option>
<option>the deplorable</option>
</select>
<label>first<input type='text' name='yourName[first][]' onfocus='Genie.tabbedOut=false' onkeydown='Genie.catchTab(event)'
 onblur='Genie.popNewGroup(this.parentNode.parentNode, {maxTotal: 10, checkForFilled: "all"})'></label>&nbsp;
<label>last<input type='text' name='yourName[last][]' onfocus='Genie.tabbedOut=false' onkeydown='Genie.catchTab(event)'
 onblur='Genie.popNewGroup(this.parentNode.parentNode, {maxTotal: 10, checkForFilled: "all"})'></label></li>
 </ol>
</fieldset><br>

<br>

<div>
<p>Enter the nicknames that others call you.&nbsp; Select the appropriate attributes of each nickname.</p>
<p>Don't be shy and show your maturity: include all those you don't like.</p>
<fieldset>
<fieldset style='display: inline-block;'><legend>favorable?</legend>
<label><input type='radio' name='Nickname[0][isliked]' value='yes' checked>yes</label>
<label><input type='radio' name='Nickname[0][isliked]' value='no'>no</label>
</fieldset>
<label>nickname<input type='text' name='Nickname[0][called]' onfocus='Genie.tabbedOut=false' onkeydown='Genie.catchTab(event)'
 onblur='Genie.popNewGroup(this.parentNode.parentNode, {indexTier:0})'></label>
<label><input type='checkbox' name='Nickname[0][lifestage][]' value='childhood'>from childhood</label>
<label><input type='checkbox' name='Nickname[0][lifestage][]' value='college'>from college</label>
<label><input type='checkbox' name='Nickname[0][lifestage][]' value='adult'>from adulthood</label>
</fieldset>
</div>

<br>

<table id='family'><caption>Enter your family tree</caption>
<tr><th>your kids</th><th>your grandkids from each kid</th></tr>

<!-- note how the indxTier option below yields no affect on kids[], but does for grandkids[0][0] -->

<tr>
<td><label>kid name<input type='text' name='kids[]' onkeydown='Genie.catchTab(event)'
 onblur='Genie.popNewGroup(this.parentNode.parentNode.parentNode, {indxTier: 0})'
 onfocus='Genie.tabbedOut=false'></label></td>
<td><label>grandkid name<input type='text' name='grandkids[0][0]' onkeydown='Genie.catchTab(event)'
 onblur='Genie.popNewGroup(this.parentNode)' onfocus='Genie.tabbedOut=false'></label></td>
</tr>

</table>

<br>

<table id='pets'><caption>Enter your pets&rsquo; names</caption>
<tr><th>Cats</th><th>Dogs</th><th>Birds</th><th>Fish</th></tr>

<tr>
<td><fieldset><label>favorite?<input type='radio' name='catNames[favorite]' value="0" update-value-genie='myGenie'></label>
<input type='text' name='catNames[]' onfocus='Genie.tabbedOut=false' onkeydown='Genie.catchTab(event)'
 onblur='Genie.popNewGroup(this.parentNode)'></fieldset></td>

<td><fieldset><label>favorite?<input type='radio' name='dogNames[favorite]' value="0" update-value-genie='myGenie'></label>
<input type='text' name='dogNames[]' onfocus='Genie.tabbedOut=false' onkeydown='Genie.catchTab(event)'
 onblur='Genie.popNewGroup(this.parentNode)'></fieldset></td>

<!-- In the next two sections, we check the input type because radio buttons may also have focus,
			and calling on the Genie when they loose focus is a waste of time.  -->

<!-- this section works just like the two above, but the event-handlers are moved to the “group”  -->
<td><fieldset onfocusin='Genie.tabbedOut=false' onkeydown='Genie.catchTab(event)'
		onfocusout='if (evet.target.type==="text")  Genie.popNewGroup(this)'>
<label>favorite?<input type='radio' name='birdNames[favorite]' value="0" update-value-genie='myGenie'></label>
<input type='text' name='birdNames[]'></fieldset></td>

<!-- this section works just like the two above, but the event-handlers are moved to the “batch”  -->
<td onfocusin='Genie.tabbedOut=false' onkeydown='Genie.catchTab(event)'
		onfocusout='if (evet.target.type==="text")  Genie.popNewGroup(event.target.closest("fieldset"))'>
<fieldset><label>favorite?<input type='radio' name='fishNames[favorite]' value="0" update-value-genie='myGenie'></label>
<input type='text' name='fishNames[]'></fieldset></td>
</tr>

</table>

<fieldset class='list'><legend>Enter your favorite types of Music</legend>
<p>(one per box)</p>
<label><input type='checkbox' name='music[1]' value='Jazz'> Jazz</label>
<label><input type='checkbox' name='music[2]' value='Rock'> Rock</label>
<label><input type='checkbox' name='music[3]' value='Blues'> Blues</label>
<label><input type='checkbox' name='music[4]' value='Vocals'> Vocals</label>
<label><input type='checkbox' name='music[5]' value='Country'> Country</label>
<!-- here we leave room for music[6] to music[19] for future expansion of defaults
		and we start again at [20] to reduce the need for our scripts to be updated in the future.
		The Genie will keep the user-entered values ordered correctly  -->
<input type='text' name='music[20]' style='display: block'
	onfocus='Genie.tabbedOut=false' onkeydown='Genie.catchTab(event)'
	onblur='Genie.popNewGroup(this)'>
</fieldset>

<fieldset class='list'><legend>Enter your favorite bands, most favorite first</legend>
<input type='text' name='favoriteBands[first]' style='display: block'
 onfocus='Genie.tabbedOut=false' onkeydown='Genie.catchTab(event)'
 onblur='Genie.popNewGroup(this, {updateName: SoftMoon.WebWare.FormFieldGenie.updateNameByList})'>
</fieldset>

<fieldset><legend>Enter your favorite movies</legend>
<div>
<label style='display: inline'>Title
<input type='text' name='favoriteMovies[i][title]' onfocus='Genie.tabbedOut=false' onkeydown='Genie.catchTab(event)'
 onblur='Genie.popNewGroup(this.parentNode.parentNode, {updateName: SoftMoon.WebWare.FormFieldGenie.updateNameByList, cbParams: SoftMoon.WebWare.FormFieldGenie.updateNameByList.RomanOrder})'></label>
<fieldset><legend>Enter the actor's names</legend>
<input type='text' name='favoriteMovies[i][actors][]' style='display: block'
	onfocus='Genie.tabbedOut=false' onkeydown='Genie.catchTab(event)' onblur='Genie.popNewGroup(this)'>
</fieldset>
</div>
</fieldset>

<br>

<script type='text/javascript'>
const PopBookOptions={
	maxTotal: 7,
	checkForFilled: "some",  // ←↓ here we specify the first two fieldNodes
	checkField: 2,   //remember this is a ONE based count
	updateName: SoftMoon.WebWare.FormFieldGenie.updateNameByList,
	cbParams: {order: SoftMoon.WebWare.FormFieldGenie.updateNameByList.RomanOrder.order,  pcre: new RegExp(/_([a-z]+)/)}  }
</script>

<fieldset><legend>modify how the “book” Genie (see next section) works:</legend>
<label style='display: block'>require “Author” &amp; “Title”
<input type='radio' name='GenieControl' onchange='PopBookOptions.checkField=2;' checked></label>
<label style='display: block'>require “Author” &amp; “summery”
<input type='radio' name='GenieControl' onchange='PopBookOptions.checkField=[0,2];'></label>
</fieldset>

<fieldset><legend>Enter your favorite books</legend>
<div class='books' onfocusin='Genie.tabbedOut=false' onkeydown='Genie.catchTab(event)'
 onfocusout='Genie.popNewGroup(this, PopBookOptions)'>
<label class='below'>Author
<input type='text' name='favoriteBooks_i_[author]'></label>
<label class='below'>Title
<textarea name='favoriteBooks_i_[title]'></textarea></label>
<label class='below'>give a short summery
<textarea name='favoriteBooks_i_[summery]'></textarea></label>
</div>
</fieldset>

<br>
<br>

<div><p></p>
<fieldset><legend>Enter your favorite cars and tell us about your feelings on them.&nbsp; One car per text-box.</legend>
<div>
<label>optional Year<input type='text' name='year1618_314159_9' size='4' maxlength='4'></label>
<input type='text' name='cars1618_314159_9' onfocus='Genie.tabbedOut=false' onkeydown='Genie.catchTab(event)'
 onblur='Genie.popNewGroup(this.parentNode, {checkForFilled: "one", checkField: 1, focusField: 1})'>
<textarea name='thoughts1618_314159_9'></textarea>
</fieldset></div>


<p>Click <input type='submit' name='submit' value='submit this form'> to see the resulting data format.</p>

</form>
</body>
</html>
