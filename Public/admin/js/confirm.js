$(document).ready(function() {
    $('.addAddress').click(function(){    
		let answer = confirm('Êtes-vous sûr de vouloir ajouter le contact ?');
		return answer;
  });
});


// $(document).ready(function(){
	
// 	$('.item .delete').click(function(){
		
// 		let elem = $(this).closest('.item');
		
// 		$.confirm({
// 			'title'		: 'Delete Confirmation',
// 			'message'	: 'You are about to delete this item. <br />It cannot be restored at a later time! Continue?',
// 			'buttons'	: {
// 				'Yes'	: {
// 					'class'	: 'blue',
// 					'action': function(){
// 						elem.slideUp();
// 					}
// 				},
// 				'No'	: {
// 					'class'	: 'gray',
// 					'action': function(){}
// 				}
// 			}
// 		});		
// 	});	
// });

$(document).ready(function() {
    $('.delete').click(function(){    
		let answer = confirm('Êtes-vous sûr de vouloir supprimer ?');
		return answer;
  });
});

$(document).ready(function() {
  $('.delete').click(function(){    
  let answer = confirm('Êtes-vous sûr de vouloir supprimer ?');
  return answer;
});
});