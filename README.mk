# 🚀 Padrão de Configuração de Projetos no Git

Este README é o passo a passo para os próximos projetos

---

## 🔧 Configuração da variáveis globais do Git (somente se ainda não estiver configurado)

```bash
git config --global user.name "pedrochassot-cpu"
git config --global user.email "pedrochassot@hotmail.com"
```

---

## 📁 Iniciar o git

```bash
git init
```

---

## 📄 Criar `.gitignore` e `README.md`

```bash
echo ".idea/
target/
node_modules/
.env" >> .gitignore
echo "# Nome do Projeto" >> README.md
```

---

## ✅ Adicionar Arquivos e Criar Primeiro Commit

```bash
git add .
git commit -m "first commit"
```

---

## 🌐 Linkar com o Git - git remote

```bash
git branch -M main
git remote add origin https://github.com/pedrochassot-cpu/repositorioNovoProjeto.git
```

---

## 🚀 Enviar os Arquivos - git push

```bash
git push -u origin main
```

---

## 📌 Adicionar novos arquivos e commits

```bash
git add .
git commit -m "Descrição da alteração"
git push
```

---

📄 **Autor:** Pedro Chassot

   **Descrição:** README para consulta dos próximos projetos de aula.