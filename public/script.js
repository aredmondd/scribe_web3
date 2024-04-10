// // Select all h3 elements with class "play"
// const playItems = document.querySelectorAll('.play');
// const rightDiv = document.querySelector('.right');

// // Loop through each h3 element
// playItems.forEach(item => {
//     // Add mouseenter event listener
//     item.addEventListener('mouseenter', () => {
//         // Loop through each h3 element again
//         playItems.forEach(innerItem => {
//             // Check if the current element is not the hovered element
//             if (innerItem !== item) {
//                 // Hide the other h3 elements
//                 innerItem.classList.add('hidden');
//             }
//         });

//         // Change background color of the .right div based on the text of the hovered h3
//         switch (item.textContent.trim()) {
//             case 'WANT TO PLAY*':
//                 rightDiv.style.backgroundColor = '#E4572E';
//                 break;
//             case 'ARE PLAYING*':
//                 rightDiv.style.backgroundColor = '#F3A712';
//                 break;
//             case 'DROPPED*':
//                 rightDiv.style.backgroundColor = '#A8C686';
//                 break;
//             case 'RETIRED*':
//                 rightDiv.style.backgroundColor = '#669BBC';
//                 break;
//             case 'COMPLETED*':
//                 rightDiv.style.backgroundColor = '#7189E0';
//                 break;
//             default:
//                 break;
//         }
//     });

//     // Add mouseleave event listener
//     item.addEventListener('mouseleave', () => {
//         // Show all h3 elements again
//         playItems.forEach(innerItem => {
//             innerItem.classList.remove('hidden');
//         });
//         // Reset background color of the .right div
//         rightDiv.style.backgroundColor = '';
//     });
// });
