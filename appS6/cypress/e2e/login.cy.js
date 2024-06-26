describe('Formulaire de Connexion', () => {
    it('test 1 - connexion OK', () => {
        cy.visit('http://localhost:8000/login');

        // Entrer le nom d'utilisateur et le mot de passe
        cy.get('#username').type('cyndelherolt@gmail.com');
        cy.get('#password').type('azerty');

        // Soumettre le formulaire
        cy.get('button[type="submit"]').click();

        // Vérifier que l'utilisateur est connecté
        cy.contains('Vous êtes connecté en tant que cyndelherolt@gmail.com').should('exist');
    });

    it('test 2 - connexion KO', () => {
        cy.visit('http://localhost:8000/login');

        // Entrer un nom d'utilisateur et un mot de passe incorrects
        cy.get('#username').type('a@a.com');
        cy.get('#password').type('aaa');

        // Soumettre le formulaire
        cy.get('button[type="submit"]').click();

        // Vérifier que le message d'erreur est affiché
        cy.contains('Invalid credentials.').should('exist');
    });
});