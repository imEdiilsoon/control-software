<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Rutinas</title>
</head>
<body>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

header {
    background-color: #0077cc;
    color: #fff;
    padding: 1rem 0;
    text-align: center;
}

#routine-generator, #nutrition-recommendations, #progress-tracking {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 2rem;
}

form {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 2rem;
    width: 300px;
    display: flex;
    flex-direction: column;
    margin-bottom: 2rem;
}

label {
    margin-top: 1rem;
}

input, select, textarea, button {
    margin-top: 0.5rem;
    padding: 0.5rem;
    border-radius: 5px;
    border: 1px solid #ccc;
}

button {
    background-color: #28a745;
    color: #fff;
    cursor: pointer;
    margin-top: 1rem;
}

button:hover {
    background-color: #218838;
}

#routine-result, #nutrition-result, #progress-result {
    margin-top: 2rem;
    width: 100%;
    max-width: 600px;
    text-align: center;
}

    </style>
    <header>
        <h1>Generador de Rutinas Personalizadas</h1>
    </header>
    <section id="routine-generator">
        <form id="routine-form">
            <label for="age">Edad:</label>
            <input type="number" id="age" name="age" required>

            <label for="weight">Peso (kg):</label>
            <input type="number" id="weight" name="weight" required>

            <label for="height">Estatura (cm):</label>
            <input type="number" id="height" name="height" required>

            <label for="goal">Objetivo:</label>
            <select id="goal" name="goal" required>
                <option value="lose_weight">Perder Peso</option>
                <option value="gain_muscle">Ganar Músculo</option>
                <option value="improve_endurance">Mejorar Resistencia</option>
            </select>

            <label for="experience">Nivel de Experiencia:</label>
            <select id="experience" name="experience" required>
                <option value="beginner">Principiante</option>
                <option value="intermediate">Intermedio</option>
                <option value="advanced">Avanzado</option>
            </select>

            <button type="submit">Generar Rutina</button>
        </form>
        <div id="routine-result"></div>
    </section>

    <section id="nutrition-recommendations">
        <h2>Recomendaciones de Nutrición</h2>
        <div id="nutrition-result"></div>
    </section>

    <section id="progress-tracking">
        <h2>Seguimiento de Progreso</h2>
        <form id="progress-form">
            <label for="date">Fecha:</label>
            <input type="date" id="date" name="date" required>

            <label for="weight-progress">Peso (kg):</label>
            <input type="number" id="weight-progress" name="weight-progress" required>

            <label for="notes">Notas:</label>
            <textarea id="notes" name="notes"></textarea>

            <button type="submit">Registrar Progreso</button>
        </form>
        <div id="progress-result"></div>
    </section>

    <footer>
        <p>© 2024 Gym Management</p>
    </footer>
    <script>
        document.getElementById('routine-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const age = document.getElementById('age').value;
    const weight = document.getElementById('weight').value;
    const height = document.getElementById('height').value;
    const goal = document.getElementById('goal').value;
    const experience = document.getElementById('experience').value;

    const routine = generateRoutine(age, weight, height, goal, experience);
    displayRoutine(routine);

    const nutrition = generateNutritionRecommendations(goal);
    displayNutrition(nutrition);
});

document.getElementById('progress-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const date = document.getElementById('date').value;
    const weightProgress = document.getElementById('weight-progress').value;
    const notes = document.getElementById('notes').value;

    const progress = {
        date,
        weight: weightProgress,
        notes
    };

    saveProgress(progress);
    displayProgress();
});

function generateRoutine(age, weight, height, goal, experience) {
    let routine = '';

    if (goal === 'lose_weight') {
        routine = `
            <h2>Rutina para Perder Peso</h2>
            <ul>
                <li>Cardio: ${experience === 'beginner' ? '20 minutos' : experience === 'intermediate' ? '30 minutos' : '45 minutos'}</li>
                <li>Entrenamiento de fuerza: ${experience === 'beginner' ? '2 series de 12 repeticiones' : experience === 'intermediate' ? '3 series de 15 repeticiones' : '4 series de 20 repeticiones'}</li>
                <li>Abdominales: ${experience === 'beginner' ? '2 series de 15 repeticiones' : experience === 'intermediate' ? '3 series de 20 repeticiones' : '4 series de 25 repeticiones'}</li>
            </ul>
        `;
    } else if (goal === 'gain_muscle') {
        routine = `
            <h2>Rutina para Ganar Músculo</h2>
            <ul>
                <li>Entrenamiento de fuerza: ${experience === 'beginner' ? '3 series de 10 repeticiones' : experience === 'intermediate' ? '4 series de 12 repeticiones' : '5 series de 15 repeticiones'}</li>
                <li>Pesas: ${experience === 'beginner' ? '3 series de 8 repeticiones' : experience === 'intermediate' ? '4 series de 10 repeticiones' : '5 series de 12 repeticiones'}</li>
                <li>Proteínas: Aumentar ingesta diaria</li>
            </ul>
        `;
    } else if (goal === 'improve_endurance') {
        routine = `
            <h2>Rutina para Mejorar Resistencia</h2>
            <ul>
                <li>Cardio: ${experience === 'beginner' ? '30 minutos' : experience === 'intermediate' ? '45 minutos' : '60 minutos'}</li>
                <li>Entrenamiento de circuito: ${experience === 'beginner' ? '2 series de 10 repeticiones' : experience === 'intermediate' ? '3 series de 15 repeticiones' : '4 series de 20 repeticiones'}</li>
                <li>Estiramientos: ${experience === 'beginner' ? '10 minutos' : experience === 'intermediate' ? '15 minutos' : '20 minutos'}</li>
            </ul>
        `;
    }

    return routine;
}

function displayRoutine(routine) {
    document.getElementById('routine-result').innerHTML = routine;
}

function generateNutritionRecommendations(goal) {
    let nutrition = '';

    if (goal === 'lose_weight') {
        nutrition = `
            <h2>Recomendaciones de Nutrición para Perder Peso</h2>
            <ul>
                <li>Desayuno: Avena con frutas y nueces</li>
                <li>Almuerzo: Ensalada de pollo con vegetales</li>
                <li>Cena: Pescado a la parrilla con verduras</li>
                <li>Snacks: Yogur bajo en grasa, frutas frescas</li>
            </ul>
        `;
    } else if (goal === 'gain_muscle') {
        nutrition = `
            <h2>Recomendaciones de Nutrición para Ganar Músculo</h2>
            <ul>
                <li>Desayuno: Huevos revueltos con espinacas y pan integral</li>
                <li>Almuerzo: Pechuga de pollo con arroz integral y brócoli</li>
                <li>Cena: Filete de ternera con quinoa y espárragos</li>
                <li>Snacks: Batidos de proteínas, frutos secos</li>
            </ul>
        `;
    } else if (goal === 'improve_endurance') {
        nutrition = `
            <h2>Recomendaciones de Nutrición para Mejorar Resistencia</h2>
            <ul>
                <li>Desayuno: Smoothie de frutas con avena y semillas de chía</li>
                <li>Almuerzo: Ensalada de quinoa con garbanzos y verduras</li>
                <li>Cena: Pasta integral con salsa de tomate y pollo</li>
                <li>Snacks: Barras energéticas, frutas secas</li>
            </ul>
        `;
    }

    return nutrition;
}

function displayNutrition(nutrition) {
    document.getElementById('nutrition-result').innerHTML = nutrition;
}

function saveProgress(progress) {
    let progressData = JSON.parse(localStorage.getItem('progressData')) || [];
    progressData.push(progress);
    localStorage.setItem('progressData', JSON.stringify(progressData));
}

function displayProgress() {
    let progressData = JSON.parse(localStorage.getItem('progressData')) || [];
    let progressHTML = '<h2>Historial de Progreso</h2><ul>';

    progressData.forEach(entry => {
        progressHTML += `
            <li>
                <strong>Fecha:</strong> ${entry.date} <br>
                <strong>Peso:</strong> ${entry.weight} kg <br>
                <strong>Notas:</strong> ${entry.notes}
            </li>
        `;
    });

    progressHTML += '</ul>';
    document.getElementById('progress-result').innerHTML = progressHTML;
}

// Inicializar el historial de progreso al cargar la página
document.addEventListener('DOMContentLoaded', displayProgress);

    </script>
</body>
</html>
