//swapping

let firstbutton = document.getElementById("firstbutton");
let secondbutton = document.getElementById("secondbutton");
let first = document.getElementById("first");
let second = document.getElementById("second");

firstbutton.addEventListener("click", () => {
  console.log("clicked");
  first.style.display = "block";
  second.style.display = "none";
});
secondbutton.addEventListener("click", () => {
  second.style.display = "block";
  first.style.display = "none";
});

//creating team
let box = document.getElementById("box");
console.log(box);
box.addEventListener("click", () => {
  console.log("clickked");
  Swal.fire({
    title: "Create Group",
    html: `<input type="text" id="group" class="swal2-input" placeholder="Teamname">
  <input type="member1" id="member1" class="swal2-input" placeholder="member1 phone number">
    <input type="member2" id="member2" class="swal2-input" placeholder="member2 phone number">
  `,
    confirmButtonText: "Create",
    focusConfirm: false,
    preConfirm: () => {
      const group = Swal.getPopup().querySelector("#group").value;
      const member1 = Swal.getPopup().querySelector("#member1").value;
      if (group == null || member1 == null) {
        Swal.showValidationMessage(`Please enter group Name and member1`);
      }
      return { group: group, member1: member1 };
    },
  }).then((result) => {
    let group = document.getElementById("group");
    let member1 = document.getElementById("member1");
    let member2 = document.getElementById("member2");

    fetch("./api/creategroup.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        phno: phno,
        group: group.value,
        member1: member1.value,
        member2: member2.value,
      }),
    })
      .then((response) => response.text())
      .then((data) =>
        Swal.fire(`${data}`).then(() => {
          location.reload();
        })
      );
  });
});

let join = document.getElementById("join");

join.addEventListener("click", () => {
  Swal.fire({
    title: "Login Form",
    html: `<input type="text" id="grpphno" class="swal2-input" placeholder="Group creator Phno">
  <input type="text" id="grpname" class="swal2-input" placeholder="Group Name">`,
    confirmButtonText: "Add Me",
    focusConfirm: false,
    preConfirm: () => {
      const grpphno = Swal.getPopup().querySelector("#grpphno").value;
      const grpname = Swal.getPopup().querySelector("#grpname").value;
      if (grpphno == null || grpname == null) {
        Swal.showValidationMessage(`Please enter grpphno and grpname`);
      }
      return { grpphno: grpphno, grpname: grpname };
    },
  }).then((result) => {
    let groupnovalue = document.getElementById("grpphno");
    let groupnamevalue = document.getElementById("grpname");
    fetch("./api/addgroup.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        groupnovalue: groupnovalue.value,
        groupnamevalue: groupnamevalue.value,
        ownnumber: phno,
      }),
    })
      .then((response) => response.text())
      .then((data) =>
        Swal.fire(`${data}`).then(() => {
          location.reload();
        })
      );
  });
});

//adding exta participants
let addp = document.getElementsByClassName("addpart");
for (let i = 0; i < addp.length; i++) {
  addp[i].addEventListener("click", () => {
    console.log(addp[i]);
    let groupname = addp[i].id;
    Swal.fire({
      title: "Add Participant",
      html: `<input type="text" id="addparticipantnumber" class="swal2-input" placeholder="participant phone number">
  `,
      confirmButtonText: "Add Participant",
      focusConfirm: false,
      preConfirm: () => {
        const number = Swal.getPopup().querySelector(
          "#addparticipantnumber"
        ).value;
        if (!number) {
          Swal.showValidationMessage(`Please enter number `);
        }
        return { number: number };
      },
    }).then((result) => {
      let addparticipantnumber = document.getElementById(
        "addparticipantnumber"
      );
     

      fetch("./api/addparticipate.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          addparticipantnumber: addparticipantnumber.value,
          groupnamevalue: groupname,
          ownnumber: phno,
        }),
      })
        .then((response) => response.text())
        .then((data) =>
          Swal.fire(`${data}`).then(() => {
            location.reload();
          })
        );
    });
  });
}


//adding expenses to own groups
let addexpenses = document.getElementsByClassName("addexpenses");
console.log(addexpenses);
for (let i = 0; i < addexpenses.length; i++) {
  addexpenses[i].addEventListener("click", () => {
    let paymentgroupname = addexpenses[i].id;
    //admin phone number is phno variable
    //paid phone number is phno variable

    Swal.fire({
      title: "Add Expenses",
      html: `<input type="text" id="amount" class="swal2-input" placeholder="Enter Expenses">
       <input type="textbox" id="inputtext" class="swal2-input" placeholder="description of Expense">`,
      confirmButtonText: "Add Expense",
      focusConfirm: false,
      preConfirm: () => {
        const amount = Swal.getPopup().querySelector("#amount").value;
        const inputtext = Swal.getPopup().querySelector("#inputtext").value;
        if (!amount || !inputtext) {
          Swal.showValidationMessage(`Please enter amount and inputtext`);
        }
        return { amount: amount, inputtext: inputtext };
      },
    }).then((result) => {

      let amount = document.getElementById("amount");
      let inputtext = document.getElementById("inputtext");
     fetch("./api/addexpensebyadmin.php", {
       method: "POST",
       headers: {
         "Content-Type": "application/json",
       },
       body: JSON.stringify({
         adminnumber: phno,
         paymentgroupnames: paymentgroupname,
         paidnumber: phno,
         amountspended: amount.value,
         description: inputtext.value
       }),
     })
       .then((response) => response.text())
       .then((data) =>
         Swal.fire(`${data}`).then(() => {
           location.reload();
         })
       );
    });

  });
}

//adding expenses to others groups
let toaddexpenses = document.getElementsByClassName("toaddexpenses");
console.log(toaddexpenses);
for (let i = 0; i < toaddexpenses.length; i++) {
  toaddexpenses[i].addEventListener("click", () => {
    let paymentsgroupname = toaddexpenses[i].id;
    let adminsphonenumber = toaddexpenses[i].classList[3];
    Swal.fire({
      title: "Add Expenses",
      html: `<input type="text" id="amount" class="swal2-input" placeholder="Enter Expenses">
       <input type="textbox" id="inputtext" class="swal2-input" placeholder="description of Expense">`,
      confirmButtonText: "Add Expense",
      focusConfirm: false,
      preConfirm: () => {
        const amount = Swal.getPopup().querySelector("#amount").value;
        const inputtext = Swal.getPopup().querySelector("#inputtext").value;
        if (!amount || !inputtext) {
          Swal.showValidationMessage(`Please enter amount and inputtext`);
        }
        return { amount: amount, inputtext: inputtext };
      },
    }).then((result) => {
      let amount = document.getElementById("amount");
      let inputtext = document.getElementById("inputtext");
      fetch("./api/addexpensebyadmin.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          adminnumber: adminsphonenumber,
          paymentgroupnames: paymentsgroupname,
          paidnumber: phno,
          amountspended: amount.value,
          description: inputtext.value,
        }),
      })
        .then((response) => response.text())
        .then((data) =>
          Swal.fire(`${data}`).then(() => {
            location.reload();
          })
        );
    });

   
  });
}


