document.addEventListener('DOMContentLoaded', () => {
    const trainers = [
        {
            name: 'Luis Villadiego',
            specialty: 'Entrenamiento de fuerza',
            bio: 'Juan tiene más de 10 años de experiencia en entrenamiento de fuerza y ha ayudado a numerosos clientes a alcanzar sus objetivos de fitness.',
            image: 'https://img.freepik.com/fotos-premium/personaje-dibujos-animados-3d-chico-gimnasio-generado-ai_911330-219.jpg',
            email: 'juan@example.com'
        },
        {
            name: 'Juan Pérez',
            specialty: 'Entrenamiento de fuerza',
            bio: 'Juan tiene más de 10 años de experiencia en entrenamiento de fuerza y ha ayudado a numerosos clientes a alcanzar sus objetivos de fitness.',
            image: 'https://img.freepik.com/fotos-premium/personaje-dibujos-animados-3d-trabajando-gimnasio_876282-8092.jpg?w=740',
            email: 'juan@example.com'
        },
        {
            name: 'Sebastian Gomez',
            specialty: 'Entrenamiento de fuerza',
            bio: 'Juan tiene más de 10 años de experiencia en entrenamiento de fuerza y ha ayudado a numerosos clientes a alcanzar sus objetivos de fitness.',
            image: 'https://img.freepik.com/fotos-premium/personaje-dibujos-animados-3d-trabajando-gimnasio_876282-8095.jpg?w=740',
            email: 'juan@example.com'
        },
        {
            name: 'María López',
            specialty: 'Yoga y Pilates',
            bio: 'María es una experta en yoga y pilates, con certificaciones internacionales y una pasión por el bienestar holístico.',
            image: 'https://img.freepik.com/vector-premium/avatar-dibujos-animados-mujeres-levantando-pesas_1080480-81473.jpg',
            email: 'maria@example.com'
        }
        // Agrega más entrenadores según sea necesario
    ];

    const trainersSection = document.getElementById('trainers');

    trainers.forEach(trainer => {
        const trainerCard = document.createElement('div');
        trainerCard.classList.add('trainer-card');

        trainerCard.innerHTML = `
    <img src="${trainer.image}" alt="${trainer.name}">
    <h2>${trainer.name}</h2>
    <p><strong>Especialidad:</strong> ${trainer.specialty}</p>
    <p>${trainer.bio}</p>
    <button class="contact-btn" onclick="contactTrainer('${trainer.email}')">Contactar</button>
    <button class="contact-btn" onclick="window.open('https://wa.me/+573116962326?text=Hola%20${trainer.name},%20Me%20gustaría%20saber%20más%20sobre%20tus%20servicios%20y%20saber%20si%20puedo%20reservar%20un%20entrenamiento%20contigo.', '_blank')">WhatsApp</button>
`;


        trainersSection.appendChild(trainerCard);
    });
});

function contactTrainer(email) {
    window.location.href = `mailto:${email}`;
}
