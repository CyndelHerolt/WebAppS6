describe('Formulaire de Création de Compte', () => {
    it('test 1 - création de compte OK', () => {
        cy.visit('http://localhost:8000/register');

        // Entrer les informations du compte
        cy.get('#registration_form_email').type('test@test.test');
        cy.get('#registration_form_plainPassword').type('azerty');
        cy.get('#registration_form_agreeTerms').check();

        // Soumettre le formulaire
        cy.get('button[type="submit"]').click();

        // Vérifier que le compte a bien été créé
        cy.contains('Vous êtes connecté en tant que test@test.test').should('exist');
    });

    it('test 2 - création de compte KO', () => {
        cy.visit('http://localhost:8000/register');

        // Entrer les informations du compte
        cy.get('#registration_form_email').type('test@test.test');
        cy.get('#registration_form_plainPassword').type('azerty');
        cy.get('#registration_form_agreeTerms').check();

        // Soumettre le formulaire
        cy.get('button[type="submit"]').click();

        // Vérifier que le message d'erreur est affiché
        cy.contains('There is already an account with this email').should('exist');
    });
});