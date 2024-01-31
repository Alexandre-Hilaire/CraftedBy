# Méthodes de travail et convention de nommage

## Méthode de travail

La méthode de travaille que j'ai choisie est la suivante : 

J'ai une branche main (master)
A partir de cette branche main je fais une branche Dev

Chaque développements est soit une nouvelle feature soit un fix d'une feature déjà merge

Une fois que ce développement est finie il passe en test, si le test passe la branche est merge dans Dev pour un nouveau test, si le test passe Dev est merge dans main

## Conventions


### Le nommages des variabbles :

- **CSS** : le `kebab-case`
- **JavaScript** : le `camelCase`
- **PHP** : le snake_case

### La convention de nommage de Laravel

- Les **Models** sont au singulier et en `PascalCase`.

### Convention de nommage des méthodes : 

- **Laravel** : `camelCase`
- 