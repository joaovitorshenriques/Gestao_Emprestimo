<x-app-layout>
  <div class="container-fluid">
    <div class="content flex-grow-1 p-4">
      @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
      @endif

      <div class="card shadow">
        <div class="card-header bg-primary text-white">
          <h3 class="card-title mb-0">Painel de emprestimos</h3>
        </div>

        <div class="card-body">
          <div class="row g-3 mb-4 dashboard-summary">
            <div class="col-6 col-lg-3">
              <div class="summary-card">
                <span class="summary-icon"><i class="fas fa-file-invoice-dollar"></i></span>
                <div>
                  <small>Total filtrado</small>
                  <strong id="summary-total">0</strong>
                </div>
              </div>
            </div>
            <div class="col-6 col-lg-3">
              <div class="summary-card">
                <span class="summary-icon"><i class="fas fa-check-circle"></i></span>
                <div>
                  <small>Ativos</small>
                  <strong id="summary-ativos">0</strong>
                </div>
              </div>
            </div>
            <div class="col-6 col-lg-3">
              <div class="summary-card">
                <span class="summary-icon warning"><i class="fas fa-clock"></i></span>
                <div>
                  <small>Em atraso</small>
                  <strong id="summary-atrasados">0</strong>
                </div>
              </div>
            </div>
            <div class="col-6 col-lg-3">
              <div class="summary-card">
                <span class="summary-icon accent"><i class="fas fa-coins"></i></span>
                <div>
                  <small>Valor total</small>
                  <strong id="summary-valor">R$ 0,00</strong>
                </div>
              </div>
            </div>
          </div>

          <div class="row mb-4 g-3 filter-panel">
            <div class="col-md-3">
              <label for="data-inicio" class="form-label">Data inicio</label>
              <input type="date" class="form-control" id="data-inicio">
            </div>
            <div class="col-md-3">
              <label for="data-fim" class="form-label">Data fim</label>
              <input type="date" class="form-control" id="data-fim">
            </div>
            <div class="col-md-3">
              <label for="cliente" class="form-label">Cliente</label>
              <select class="form-select" id="cliente">
                <option value="">Todos os clientes</option>
                @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3">
              <label for="status" class="form-label">Status</label>
              <select class="form-select" id="status">
                <option value="">Todos</option>
                @foreach($emprestimoStatus as $valor => $rotulo)
                <option value="{{ $valor }}">{{ $rotulo }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-12 mt-2">
              <div class="d-flex justify-content-end">
                <button id="btn-limpar" class="btn btn-outline-secondary">
                  <i class="fas fa-broom"></i> Limpar filtros
                </button>
              </div>
            </div>
          </div>

          <div class="table-responsive">
            <table id="tabela-emprestimos" class="table table-striped table-hover align-middle">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Cliente</th>
                  <th>Valor total</th>
                  <th>Contratacao</th>
                  <th>Status</th>
                  <th>Parcelas</th>
                  <th>Acoes</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalGarantia" tabindex="-1" aria-labelledby="modalGarantiaLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalGarantiaLabel">Detalhes da garantia</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          <p><strong>Tipo:</strong> <span id="garantia-tipo"></span></p>
          <p><strong>Descricao:</strong> <span id="garantia-descricao"></span></p>
          <p><strong>Valor avaliado:</strong> R$ <span id="garantia-valor"></span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      let todosEmprestimos = [];

      function getTodosClientesIds() {
        return $('#cliente option')
          .map(function() {
            return $(this).val();
          })
          .get()
          .filter(id => id !== "");
      }

      carregarEmprestimos(getTodosClientesIds());

      function carregarEmprestimos(clienteId = null) {
        $.ajax({
          url: "{{ route('emprestimo.lista-emprestimos') }}",
          type: "POST",
          data: {
            _token: "{{ csrf_token() }}",
            cliente_id: clienteId
          },
          beforeSend: function() {
            $('#tabela-emprestimos tbody').html(`
              <tr>
                <td colspan="7" class="text-center py-4">
                  <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Carregando...</span>
                  </div>
                </td>
              </tr>
            `);
          },
          success: function(response) {
            if (response.success) {
              todosEmprestimos = response.emprestimos;
              aplicarFiltros();
            } else {
              todosEmprestimos = [];
              aplicarFiltros();
            }
          },
          error: function() {
            $('#tabela-emprestimos tbody').html(`
              <tr>
                <td colspan="7" class="text-center text-danger py-4">Erro ao carregar emprestimos</td>
              </tr>
            `);
          }
        });
      }

      function aplicarFiltros() {
        const dataInicio = $('#data-inicio').val();
        const dataFim = $('#data-fim').val();
        const status = $('#status').val();

        let emprestimosFiltrados = [...todosEmprestimos];

        if (dataInicio) {
          const inicio = new Date(dataInicio);
          emprestimosFiltrados = emprestimosFiltrados.filter(e => {
            return new Date(e.data_contratacao) >= inicio;
          });
        }

        if (dataFim) {
          const fim = new Date(dataFim);
          emprestimosFiltrados = emprestimosFiltrados.filter(e => {
            return new Date(e.data_contratacao) <= fim;
          });
        }

        if (status) {
          emprestimosFiltrados = emprestimosFiltrados.filter(e => e.status === status);
        }

        renderizarEmprestimos(emprestimosFiltrados);
        atualizarResumo(emprestimosFiltrados);
      }

      function renderizarEmprestimos(emprestimos) {
        var tbody = $('#tabela-emprestimos tbody').empty();

        if (!emprestimos.length) {
          tbody.html(`
            <tr>
              <td colspan="7" class="text-center py-4 text-muted">
                Nenhum emprestimo encontrado com os filtros selecionados.
              </td>
            </tr>
          `);
          return;
        }

        emprestimos.forEach(function(emprestimo) {
          var statusClass = {
            'ativo': 'success',
            'quitado': 'primary',
            'atrasado': 'danger'
          } [emprestimo.status] || 'secondary';

          var parcelasPagas = emprestimo.parcelas.filter(p => p.status.toLowerCase() === 'pago').length;
          var parcelasText = `${parcelasPagas}/${emprestimo.parcelas.length || 0}`;

          var tr = $(`
            <tr>
              <td>#${emprestimo.id}</td>
              <td>${emprestimo.cliente_nome}</td>
              <td>R$ ${parseFloat(emprestimo.valor_total).toFixed(2).replace('.', ',')}</td>
              <td>${new Date(emprestimo.data_contratacao + "T00:00:00").toLocaleDateString('pt-BR')}</td>
              <td>
                <span class="badge bg-${statusClass}">
                  ${emprestimo.status.toUpperCase()}
                </span>
              </td>
              <td>${parcelasText}</td>
              <td>
                <div class="d-flex gap-2">
                  <button class="btn btn-sm btn-outline-primary btn-ver-parcelas" data-id="${emprestimo.id}" title="Ver parcelas">
                    <i class="fas fa-list"></i>
                  </button>
                  ${(emprestimo.garantia_tipo || emprestimo.garantia_descricao || emprestimo.garantia_valor) ? `
                    <button class="btn btn-sm btn-outline-warning btn-ver-garantia"
                      data-tipo="${emprestimo.garantia_tipo || 'Nao informado'}"
                      data-descricao="${emprestimo.garantia_descricao || 'Nao informado'}"
                      data-valor="${emprestimo.garantia_valor || '0.00'}"
                      title="Ver garantias">
                      <i class="fas fa-shield-alt"></i>
                    </button>
                  ` : ''}
                </div>
              </td>
            </tr>
          `);

          tr.find('.btn-ver-garantia').click(function() {
            const tipo = $(this).data('tipo');
            const descricao = $(this).data('descricao');
            const valor = $(this).data('valor');

            $('#garantia-tipo').text(tipo);
            $('#garantia-descricao').text(descricao);
            $('#garantia-valor').text(parseFloat(valor).toFixed(2).replace('.', ','));
            $('#modalGarantia').modal('show');
          });

          var trDetalhes = $(`
            <tr class="detalhes-parcelas" id="detalhes-${emprestimo.id}" style="display: none;">
              <td colspan="7">
                <div class="p-3 details-panel">
                  <h6>Parcelas do emprestimo #${emprestimo.id}</h6>
                  <table class="table table-sm">
                    <thead>
                      <tr>
                        <th>Parcela</th>
                        <th>Valor</th>
                        <th>Vencimento</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      ${renderizarParcelas(emprestimo.parcelas)}
                    </tbody>
                  </table>
                </div>
              </td>
            </tr>
          `);

          tbody.append(tr);
          tbody.append(trDetalhes);
        });

        $('.btn-ver-parcelas').click(function() {
          var id = $(this).data('id');
          $('#detalhes-' + id).toggle();
        });
      }

      function renderizarParcelas(parcelas) {
        var html = '';
        parcelas.forEach(function(parcela) {
          var statusClass = {
            'pago': 'success',
            'pendente': 'warning',
            'atrasado': 'danger'
          } [parcela.status] || 'secondary';

          html += `
            <tr>
              <td>${parcela.numero_parcela}</td>
              <td>R$ ${parseFloat(parcela.valor_parcela).toFixed(2).replace('.', ',')}</td>
              <td>${new Date(parcela.data_vencimento).toISOString().split('T')[0].split('-').reverse().join('/')}</td>
              <td>
                <span class="badge bg-${statusClass}">
                  ${parcela.status.toUpperCase()}
                </span>
              </td>
            </tr>
          `;
        });
        return html;
      }

      function atualizarResumo(emprestimos) {
        const total = emprestimos.length;
        const ativos = emprestimos.filter(e => e.status === 'ativo').length;
        const atrasados = emprestimos.filter(e => e.status === 'atrasado').length;
        const valorTotal = emprestimos.reduce((acc, emprestimo) => {
          return acc + (parseFloat(emprestimo.valor_total) || 0);
        }, 0);

        $('#summary-total').text(total);
        $('#summary-ativos').text(ativos);
        $('#summary-atrasados').text(atrasados);
        $('#summary-valor').text(valorTotal.toLocaleString('pt-BR', {
          style: 'currency',
          currency: 'BRL'
        }));
      }

      $('#cliente').change(function() {
        var clienteId = $(this).val();
        if (clienteId === '') {
          clienteId = getTodosClientesIds();
        }
        carregarEmprestimos(clienteId);
      });

      $('#status, #data-inicio, #data-fim').change(function() {
        aplicarFiltros();
      });

      $('#btn-limpar').click(function() {
        $('#data-inicio').val('');
        $('#data-fim').val('');
        $('#status').val('');
        $('#cliente').val('');
        carregarEmprestimos(getTodosClientesIds());
      });
    });
  </script>
</x-app-layout>
