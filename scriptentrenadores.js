document.addEventListener('DOMContentLoaded', () => {
    const trainers = [
        {
            name: 'Luis Villadiego',
            specialty: 'Entrenamiento de fuerza',
            bio: 'Juan tiene más de 10 años de experiencia en entrenamiento de fuerza y ha ayudado a numerosos clientes a alcanzar sus objetivos de fitness.',
            image: 'juan.jpg',
            email: 'juan@example.com'
        },
        {
            name: 'Juan Pérez',
            specialty: 'Entrenamiento de fuerza',
            bio: 'Juan tiene más de 10 años de experiencia en entrenamiento de fuerza y ha ayudado a numerosos clientes a alcanzar sus objetivos de fitness.',
            image: 'juan.jpg',
            email: 'juan@example.com'
        },
        {
            name: 'Sebastian Gomez',
            specialty: 'Entrenamiento de fuerza',
            bio: 'Juan tiene más de 10 años de experiencia en entrenamiento de fuerza y ha ayudado a numerosos clientes a alcanzar sus objetivos de fitness.',
            image: 'juan.jpg',
            email: 'juan@example.com'
        },
        {
            name: 'María López',
            specialty: 'Yoga y Pilates',
            bio: 'María es una experta en yoga y pilates, con certificaciones internacionales y una pasión por el bienestar holístico.',
            image: 'maria.jpg',
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
        `;

        trainersSection.appendChild(trainerCard);
    });
});

function contactTrainer(email) {
    window.location.href = `mailto:${email}`;
}
