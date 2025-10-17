// Sample JSON-like object with Krushi Sahay–specific data
const data = {
  events: [
    { title: "PM-KISAN Awareness Camp", date: "10 Sept 2025", venue: "Village Panchayat Hall", description: "Explaining step-by-step process of registering under PM-KISAN scheme." },
    { title: "Crop Insurance Workshop", date: "18 Sept 2025", venue: "District Agriculture Office", description: "Training farmers on how to claim benefits under PMFBY scheme." },
    { title: "Soil Health Card Drive", date: "25 Sept 2025", venue: "Taluka Agriculture Center", description: "Free soil testing and distribution of soil health cards to farmers." },
    { title: "Irrigation Awareness Program", date: "2 Oct 2025", venue: "Community Ground", description: "Awareness on PMKSY scheme for better irrigation management." },
    { title: "Organic Farming Training", date: "5 Oct 2025", venue: "Krushi Vikas Kendra", description: "Practical training on organic farming and natural fertilizers." },
    { title: "Farmer Grievance Redressal Camp", date: "12 Oct 2025", venue: "NGO Office", description: "Session for farmers to file complaints about delayed subsidies." },
    { title: "Agri-Tech Exhibition", date: "20 Oct 2025", venue: "University Campus", description: "Showcasing latest tools, apps, and technology for farmers." },
    { title: "eNAM Market Training", date: "28 Oct 2025", venue: "Market Yard", description: "Helping farmers register and sell crops directly through eNAM." },
    { title: "Credit Awareness Camp", date: "5 Nov 2025", venue: "Bank Auditorium", description: "Guidance for farmers on how to apply for Kisan Credit Card (KCC)." },
    { title: "Smart Farming Seminar", date: "15 Nov 2025", venue: "Agriculture College", description: "Sessions on use of drones, IoT sensors, and AI for smart farming." }
  ],
  farmers: [  
    { name: "Ramesh Patel", age: 45, village: "Anand", crops: "Wheat, Rice", schemes: "PM-KISAN, Soil Health Card" },
    { name: "Meena Joshi", age: 42, village: "Surat", crops: "Sugarcane, Vegetables", schemes: "Organic Farming, eNAM" },
    { name: "Suresh Desai", age: 38, village: "Vadodara", crops: "Cotton, Groundnut", schemes: "PMFBY, PMKSY" },
    { name: "Kiran Chauhan", age: 50, village: "Rajkot", crops: "Millets, Bajra", schemes: "NFSM, PM-KISAN" },
    { name: "Sunita Parmar", age: 35, village: "Ahmedabad", crops: "Maize, Pulses", schemes: "RKVY, PMFBY" },
    { name: "Mahesh Shah", age: 40, village: "Bhavnagar", crops: "Cotton, Onion", schemes: "PMKSY, AIF" },
    { name: "Kamla Singh", age: 37, village: "Nadiad", crops: "Vegetables, Fruits", schemes: "NHM, Soil Health Card" },
    { name: "Arun Trivedi", age: 48, village: "Jamnagar", crops: "Groundnut, Wheat", schemes: "PM-KISAN, KCC" },
    { name: "Lakshmi Rathod", age: 36, village: "Patan", crops: "Rice, Pulses", schemes: "PKVY, PMFBY" },
    { name: "Bharat Mehta", age: 44, village: "Gandhinagar", crops: "Wheat, Cotton", schemes: "PM-KISAN, RKVY" }
  ]
};

// Display Events
const eventList = document.getElementById("events");
data.events.forEach(ev => {
  let div = document.createElement("div");
  div.className = "card";
  div.innerHTML = `
    <h4>${ev.title}</h4>
    <p><strong>Date:</strong> ${ev.date}</p>
    <p><strong>Venue:</strong> ${ev.venue}</p>
    <p>${ev.description}</p>
  `;
  eventList.appendChild(div);
});

// Display Farmers
const farmerDiv = document.getElementById("farmers");
data.farmers.forEach(fm => {
  let div = document.createElement("div");
  div.className = "card";
  div.innerHTML = `
    <h4>${fm.name}</h4>
    <p><strong>Age:</strong> ${fm.age}</p>
    <p><strong>Village:</strong> ${fm.village}</p>
    <p><strong>Crops:</strong> ${fm.crops}</p>
    <p><strong>Schemes Availed:</strong> ${fm.schemes}</p>
  `;
  farmerDiv.appendChild(div);
});
