# 📚 Sistema Escolar

Sistema web para gestão de **ocorrências escolares** (entrada atrasada e saída antecipada), com fluxo de aprovação entre perfis:

- AQV
- Portaria
- Professores

---

## 📌 Visão Geral

O Sistema Escolar centraliza o controle de ocorrências de alunos, garantindo um fluxo organizado de validação, aprovação e notificação entre setores da escola.

O sistema trabalha com **controle por perfis (roles)** e um fluxo hierárquico de decisões.

---

## 🔄 Fluxo de Dados do Sistema

O fluxo de dados representa o ciclo completo de uma ocorrência dentro do sistema.

### 1. Registro da Ocorrência (AQV)

A AQV cria uma ocorrência vinculada a um aluno.

Dados registrados:

- aluno_id
- tipo da ocorrência:
  - entrada atrasada
  - saída antecipada
- data e hora
- status inicial: `pendente`

---

### 2. Validação da AQV

A AQV analisa a solicitação e decide:

- ✔ Aprovar → status: `aprovado`
- ✖ Negar → status: `negado`

Somente ocorrências aprovadas seguem no fluxo.

---

### 3. Distribuição Automática de Dados

Quando a ocorrência é aprovada:

- O sistema gera notificações automaticamente
- Portaria recebe a notificação
- Professores recebem a notificação
- O processo ocorre via eventos internos do sistema

---

### 4. Processamento na Portaria

A Portaria:

- Confirma a entrada ou saída do aluno
- Valida a liberação física
- Registra a confirmação no sistema

---

### 5. Visualização pelos Professores

Os professores:

- Apenas visualizam notificações
- Não podem alterar dados
- Acompanham ocorrências aprovadas

---

## 🧠 Modelo de Dados

### users
- name
- email
- password
- role (`aqv`, `portaria`, `professor`)

### alunos
- nome
- RM
- turma
- curso
- responsável
- status

### ocorrencias
- aluno_id
- tipo
- status (`pendente`, `aprovado`, `negado`)
- data/hora

### notificacoes
- user_id
- mensagem
- ocorrência vinculada

---

## 🔐 Regras de Negócio

- Apenas AQV pode criar ocorrências
- Apenas AQV pode aprovar ou negar ocorrências
- Portaria apenas confirma liberações físicas
- Professores apenas visualizam dados
- Toda ocorrência aprovada gera notificação automática

---

## 🔄 Fluxo Resumido

1. AQV registra ocorrência
2. AQV aprova ou nega
3. Se aprovado:
   - Sistema envia notificações
   - Portaria recebe liberação
   - Professores recebem aviso
4. Portaria confirma liberação física

---

## 🎯 Objetivo do Sistema

- Centralizar o controle de entradas e saídas
- Evitar inconsistências manuais
- Garantir rastreabilidade total
- Integrar setores da escola em um fluxo único

---

## 📦 Tecnologias

- PHP 8.3+
- Laravel
- Tailwind CSS
- Vite
- Alpine.js
- SQLite / MySQL

---

## 📌 Estrutura do Fluxo

```txt
AQV → cria ocorrência → pendente
AQV → aprova/nega
    ↓
Se aprovado:
    → Notificação automática
    → Portaria (confirmação física)
    → Professores (visualização)